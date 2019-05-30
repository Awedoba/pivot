<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand">
                    <div class="brand-logo"></div>
                    <h2 class="brand-text mb-0">Pivot</h2></a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item {{\Request::is('home*')? 'sidebar-group-active open' :''}}">
                <a href=""><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span><span class="badge badge badge-warning badge-pill float-right mr-2">2</span></a>
                <ul class="menu-content">
                    <li class="{{ preg_match('/home/',\Route::current()->getName())? 'active' :''}}"><a href="{{route('home')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">Analytics</span></a>
                    </li>
                    <li><a href="{{route('home')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="eCommerce">eCommerce</span></a>
                    </li>
                </ul>
            </li>
            <li class=" navigation-header"><span>Apps</span>
            </li>
            <li class=" nav-item {{ preg_match('/home/',\Route::current()->getName())? 'active' :''}}"><a href="{{route('home')}}"><i class="feather icon-mail"></i><span class="menu-title" data-i18n="Email">Email</span></a>
            </li>

        </ul>
    </div>
</div>
<!-- END: Main Menu-->