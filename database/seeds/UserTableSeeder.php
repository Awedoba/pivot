<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=\App\User::create([
            'fname'=>'Mel',
            'lname'=>'Logo',
            'gender'=>'Male',
            'username'=>'codehq',
            'email'=>'cto@emezak.com',
            'phone'=>'1234567790',
            'password'=>\Illuminate\Support\Facades\Hash::make('12345678'),
        ]);
        $user->assignRole('Super Admin');
    }
}
