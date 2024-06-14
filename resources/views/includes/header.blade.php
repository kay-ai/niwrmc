<div class="container-fluid g-0">
    <div class="row">
        <div class="col-lg-12 p-0">
            <div class="header_iner d-flex justify-content-between align-items-center">
                <div class="sidebar_icon d-lg-none">
                    <i class="ti-menu"></i>
                </div>
                <div class="serach_field-area">
                    <div class="search_inner">
                        <form action="#">
                            <div class="search_field">
                                <input type="text" placeholder="Search here...">
                            </div>
                            <button type="submit"> <img src="img/icon/icon_search.svg" alt="">
                            </button>
                        </form>
                    </div>
                </div>
                <div class="header_right d-flex justify-content-between align-items-center">
                    {{-- <div class="header_notification_warp d-flex align-items-center">
                        <li>
                            <a href="#"> <img src="img/icon/bell.svg" alt=""> </a>
                        </li>
                        <li>
                            <a href="#"> <img src="img/icon/msg.svg" alt=""> </a>
                        </li>
                    </div> --}}
                    <div class="profile_info">
                        @if(Auth::guard('customer')->check())
                            <img src="/storage/{{auth()->guard('customer')->user()->passport}}" alt="User Avatar">
                        @else
                            <img src="/img/logo.png" alt="User Avatar">
                        @endif
                        <div class="profile_info_iner">
                            <p>Welcome!</p>
                            <h5>{{auth()->user()->first_name . ' '. auth()->user()->last_name}}</h5>
                            <div class="profile_info_details">
                                @if (auth()->guard('customer')->check())
                                    <a href="/profile">My Profile <i class="ti-user"></i></a>
                                @else
                                    <a href="/user-profile">My Profile <i class="ti-user"></i></a>
                                @endif
                                <a href="javascript:void(0);"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Log Out <i class="ti-shift-left"></i>
                                </a>
                                <form id="logout-form" action="{{ route('logout.customer') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
