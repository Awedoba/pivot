<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    protected $credentials;
    protected $users_data;


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'home';
    protected $redirectPassword = 'change.password';
    protected $redirectLogin = 'login';
    protected $max_count = 5;
    protected $max_time = 7;
    protected $max_lock_count = 10;
    protected $max_lock_time = 20;
    protected $max_time_units = 'minutes';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }


    public function login(Request $request)
    {
        if (strtoupper($request->method()) == 'POST') {
            $request->validate([
                'login' => 'required|string',
                'password' => 'required|string'
            ]);

            $login = $request->login;
            $login_type = $this->checkLoginType($login);
            $user_data = $this->getUser($login_type, $login);
            $this->users_data = $user_data;
            //Todo:: add verification of email and set alert message
//        if (empty($this->users_data->email_verified_at)){
//            $url= URL::temporarySignedRoute(
//                'confirm', now()->addMinutes(30), ['user' => $this->users_data->id]
//            );
////            return new SendEmailVerificationMail(User::find($this->users_data->id),$url);
//            dispatch(new SendEmailVerificationMail(User::find($this->users_data->id),$url));
////            session()->flash('','Check your Email for a verification link.');
//            return $this->notConfirmed($login_type);
//        }
            $this->credentials = $request->only('password') + [$login_type => $login] + ['is_locked' => 0];
            $attempt = $this->attemptLogin($this->credentials, $request->has('remember') ? true : false);

            if ($attempt === false) {
                return $this->passwordAttemptCounter($user_data, $login_type);
            } else {
                return $this->isLoggedIn(Auth::user());
            }


        }
        return view('guest.login.index');

    }

    public function logout()
    {
        $user = Auth::user();
//        dd($user);
        $user->is_login = false;
        $user->user_ip = null;
        $user->save();
        Auth::logout();
        \request()->session()->invalidate();
        Cache::flush();
        activity()->causedBy($user)->performedOn($user)->withProperties($user)->log("User Logged Out");
        return redirect()->route($this->redirectLogin);
    }

    protected function getUser($login_type, $login)
    {
        if ($login_type == 'email') {
            $_user = User::where($login_type, $login)->first();
            return !empty($_user) ? $_user : $this->accountNotFound($login_type);
        } elseif ($login_type == 'username') {
            $_user = User::where($login_type, $login)->first();
            return !empty($_user) ? $_user : $this->accountNotFound($login_type);
        }
    }

    protected function checkLoginType($login)
    {
        return filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

    }

    protected function attemptLogin($credential, $remember = false)
    {
        return Auth::attempt(
            $this->credentials, $remember
        );
    }

    protected function mustChangePassword($user)
    {
        return $user->must_change_password == false ? false : true;
    }

    protected function passwordAttemptCounter($user, $login_type)
    {
        if ($user->is_locked) {
            return $this->accountLocked($login_type);
        }
        if ($user->password_attempt_count == 0) {
            $user->password_attempt_date = Carbon::now();
        }
        $user->password_attempt_count++;
        $user->save();
        if ($user->password_attempt_count == $this->max_count) {
            $time = Carbon::now()->addMinute($this->max_time);
            Cache::forever('wait_timer', $time);

        } elseif ($user->password_attempt_count == $this->max_lock_count) {
//            $time = Carbon::now()->addMinute($this->max_lock_time);
//            Cache::forever('wait_timer', $time);
        }

//
        if (Cache::has('wait_timer')) {
            $time_end = Carbon::createFromFormat('Y-m-d H:i:s', Cache::get('wait_timer'));
            $time_nom = Carbon::now();
            $time_diff = $time_nom->diffInMinutes($time_end, false);
            if ($user->password_attempt_count > $this->max_lock_count) {
                if ($user->is_locked == true) {
                    return $this->accountLocked($login_type);
                }
                $user->is_locked = true;
                $user->save();
                $this->accountLocked($login_type);


            } else {
                if ($time_diff > 0) {

                    if ($user->is_locked == true) {
                        $this->accountLocked($login_type);
                    }
                    return $this->tooManyLoginTries($login_type, $time_diff, $this->max_time_units);
                } else {
                    if ($user->is_locked == true) {
                        $this->accountLocked($login_type);
                    }
                    $user->password_attempt_count = 0;
                    $user->password_attempt_date = null;
                    $user->save();
                    Cache::flush();
                    return redirect()->route($this->redirectLogin);
                }

            }

        }

        return $this->wrongCredentials($login_type);

    }

    protected function getCounter()
    {
        return intval($this->max_lock_count - $this->users_data->password_attempt_count);

    }

    protected function isLoggedIn($user)
    {

        $user->password_attempt_count = 0;
        $user->password_attempt_date = null;
        $user->is_login = true;
        $user->user_ip = \request()->getClientIp();
        $user->save();

        // Todo:: user must change password if account was created by admin or super admin
//        $must_change = $this->mustChangePassword($user);

//        if ($must_change) {
////            return redirect()->route()
////            return redirect()->route()
//            return redirect()->route($this->redirectPassword,['user'=>$user->id])->with('alert-info','You have to change your default password');
//        } else {

        activity()->causedBy($user)->performedOn($user)->withProperties($user)->log("User Logged in");


        $url = $this->getRoleURI($user);

        return redirect()->route($url);
    }

//    }

    public function getRoleURI($user)
    {
        $URI = $this->redirectTo;
        $role = $user->getRoleNames()->first();

        switch ($role) {
            case "Super Admin":
                $URI = "home";
                break;
            case "Administrator":
                $URI = "purchaseorder.index";
                break;
            case "Accountant":
                $URI = "journal.index";
                break;
            case "Store Keeper":
                $URI = "item.index";
                break;
            case "Cashier":
                $URI = "salesorder.index";
                break;
            case "Sales Person":
                $URI = "salesorder.index";
                break;
            case "Operations":
                $URI = "purchaseorder.index";
                break;
            default:
                $URI = "home";
        }
//        Todo role destination here

        return $URI;
    }

    protected function accountNotFound($login_type)
    {
        throw ValidationException::withMessages([
            $login_type => [trans('auth.notFound')],
        ]);
    }

    protected function tooManyLoginTries($login_type, $seconds, $units)
    {
        throw ValidationException::withMessages([
            $login_type => [Lang::get('auth.loginAttempts', ['seconds' => $seconds, 'units' => $units, 'try' => $this->getCounter()])],
        ])->status(429);

    }

    protected function wrongCredentials($login_type)
    {
        throw ValidationException::withMessages([
            $login_type => [trans('auth.failed')],
        ]);
    }

    protected function notConfirmed($login_type)
    {
        throw ValidationException::withMessages([
            $login_type => [trans('auth.notConfirmed')],
        ]);
    }

    protected function accountLocked($login_type)
    {
        throw ValidationException::withMessages([
            $login_type => [trans('auth.lockedAccount')],
        ]);
    }

}
