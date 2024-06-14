<nav class="sidebar">
    <div class="logo d-flex justify-content-between">
        <a href="/" style="    margin-top: -30px;"><img src="img/logo.png" style="height: 50px;"></a>
        <div class="sidebar_close_icon d-lg-none">
            <i class="ti-close"></i>
        </div>
    </div>
    <ul id="sidebar_menu">
        @if(Auth::guard('customer')->check())
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
                <a class="" href="/profile">
                    <img src="img/menu-icon/6.svg" alt="">
                    <span>My Profile</span>
                </a>
            </li>
        <hr class="mt-5">
        @else
            <li class="{{request()->is('user-dashboard') ? 'mm-active' : ''}}">
                <a class="" href="/user-dashboard">
                    <img src="img/menu-icon/1.svg" alt="">
                    <span>Dashboard</span>
                </a>
            </li>
            @can('view menu-invoices')
                <li class="{{request()->is('invoices') ? 'mm-active' : ''}}">
                    <a class="" href="/invoices">
                        <img src="img/menu-icon/2.svg" alt="">
                        <span>Invoices</span>
                    </a>
                </li>
            @endcan
            @can('view menu-payments')
                <li class="{{request()->is('payments') ? 'mm-active' : ''}}">
                    <a class="" href="/payments">
                        <i class="ti-receipt"></i>
                        <span>Payments</span>
                    </a>
                </li>
            @endcan
            @can('view menu-licenses')
                <li class="{{request()->is('licenses') ? 'mm-active' : ''}}">
                    <a class="" href="/licenses">
                        <i class="ti-file"></i>
                        <span>Licenses</span>
                    </a>
                </li>
            @endcan
            @can('view menu-customers')
                <li class="{{request()->is('customers') ? 'mm-active' : ''}}">
                    <a class="" href="/customers">
                        <img src="img/menu-icon/6.svg" alt="">
                        <span>Customers</span>
                    </a>
                </li>
            @endcan
            @can('view menu-categories')
                <li class="{{request()->is('categories') ? 'mm-active' : ''}}">
                    <a class="" href="/categories">
                        <i class="ti-list"></i>
                        <span>Categories</span>
                    </a>
                </li>
            @endcan
            @can('view menu-license-types')
                <li class="{{request()->is('subcategories') ? 'mm-active' : ''}}">
                    <a class="" href="/subcategories">
                        <img src="img/menu-icon/7.svg" alt="">
                        <span>License Types</span>
                    </a>
                </li>
            @endcan
            <hr>
            @can('view menu-roles')
                <li class="{{request()->is('license-prices') ? 'mm-active' : ''}}">
                    <a class="" href="/roles">
                        <i class="ti-receipt"></i>
                        <span>Roles</span>
                    </a>
                </li>
            @endcan
            @can('view menu-permissions')
                <li class="{{request()->is('license-prices') ? 'mm-active' : ''}}">
                    <a class="" href="/permissions">
                        <i class="ti-printer"></i>
                        <span>Permissions</span>
                    </a>
                </li>
            @endcan
            @can('view menu-assign-permissions')
                <li class="{{request()->is('license-prices') ? 'mm-active' : ''}}">
                    <a class="" href="/permission-assignment">
                        <i class="ti-printer"></i>
                        <span>Assign Permissions</span>
                    </a>
                </li>
            @endcan
            @can('view menu-users')
                <li class="{{request()->is('users') ? 'mm-active' : ''}}">
                    <a class="" href="/users">
                        <i class="ti-user"></i>
                        <span>Users</span>
                    </a>
                </li>
            @endcan
        @endif
        <li>
            <a href="javascript:void(0);"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="ti-shift-left"></i>
                <span>Log Out</span>
            </a>
            <form id="logout-form" action="{{ route('logout.customer') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</nav>
