<nav class="sidebar">
    <div class="logo d-flex justify-content-between">
        <a href="/" style="    margin-top: -30px;"><img src="img/logo.png" style="height: 50px;"></a>
        <div class="sidebar_close_icon d-lg-none">
            <i class="ti-close"></i>
        </div>
    </div>
    @if(Auth::guard('customer')->check())
        <ul id="sidebar_menu">
            <li class="{{request()->is('customer-dashboard') ? 'mm-active' : ''}}">
                <a class="" href="/customer-dashboard">
                    <img src="img/menu-icon/1.svg" alt="">
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="{{request()->is('customer-invoices') ? 'mm-active' : ''}}">
                <a class="" href="/customer-invoices">
                    <img src="img/menu-icon/2.svg" alt="">
                    <span>Invoices</span>
                </a>
            </li>
            <li class="{{request()->is('customer-licenses') ? 'mm-active' : ''}}">
                <a class="" href="/customer-licenses">
                    <i class="ti-file"></i>
                    <span>Licenses</span>
                </a>
            </li>
            <li class="{{request()->is('customer-payments') ? 'mm-active' : ''}}">
                <a class="" href="/customer-payments">
                    <i class="ti-receipt"></i>
                    <span>Payments</span>
                </a>
            </li>
            {{-- <li class="{{request()->is('apply-license') ? 'mm-active' : ''}}" >
                <a class="" href="/apply-license">
                    <img src="img/menu-icon/3.svg" alt="">
                    <span>Apply For License</span>
                </a>
            </li> --}}
            <hr>
            <li class="">
                <a class="" href="#">
                    <img src="img/menu-icon/6.svg" alt="">
                    <span>My Profile</span>
                </a>
            </li>
        </ul>
    @else
        <ul id="sidebar_menu">
            <li class="{{request()->is('user-dashboard') ? 'mm-active' : ''}}">
                <a class="" href="/user-dashboard">
                    <img src="img/menu-icon/1.svg" alt="">
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="{{request()->is('invoices') ? 'mm-active' : ''}}">
                <a class="" href="/invoices">
                    <img src="img/menu-icon/2.svg" alt="">
                    <span>Invoices</span>
                </a>
            </li>
            <li class="{{request()->is('payments') ? 'mm-active' : ''}}">
                <a class="" href="/payments">
                    <i class="ti-receipt"></i>
                    <span>Payments</span>
                </a>
            </li>
            <li class="{{request()->is('licenses') ? 'mm-active' : ''}}">
                <a class="" href="/licenses">
                    <i class="ti-file"></i>
                    <span>Licenses</span>
                </a>
            </li>
            <li class="{{request()->is('customers') ? 'mm-active' : ''}}">
                <a class="" href="/customers">
                    <img src="img/menu-icon/6.svg" alt="">
                    <span>Customers</span>
                </a>
            </li>
            <li class="{{request()->is('categories') ? 'mm-active' : ''}}">
                <a class="" href="/categories">
                    <i class="ti-list"></i>
                    <span>Categories</span>
                </a>
            </li>
            <li class="{{request()->is('subcategories') ? 'mm-active' : ''}}">
                <a class="" href="/subcategories">
                    <img src="img/menu-icon/7.svg" alt="">
                    <span>License Types</span>
                </a>
            </li>
            <hr>
            <li class="{{request()->is('license-prices') ? 'mm-active' : ''}}">
                <a class="" href="/license-prices">
                    <i class="ti-receipt"></i>
                    <span>Roles</span>
                </a>
            </li>
            <li class="{{request()->is('license-prices') ? 'mm-active' : ''}}">
                <a class="" href="/license-prices">
                    <i class="ti-printer"></i>
                    <span>Permissions</span>
                </a>
            </li>
            <li class="{{request()->is('staff') ? 'mm-active' : ''}}">
                <a class="" href="/staff">
                    <i class="ti-user"></i>
                    <span>Staff</span>
                </a>
            </li>
        </ul>
    @endif
</nav>
