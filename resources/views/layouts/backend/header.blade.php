<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-dark navbar-shadow">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon"
                                                                                                   data-feather="menu"></i></a>
                </li>
            </ul>
            <ul class="nav navbar-nav">
                <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon"
                                                                                             data-feather="sun"></i></a>
                </li>
            </ul>

            <ul class="nav navbar-nav align-items-center ml-auto">
                <li class="nav-item dropdown dropdown-language">
                    @foreach($languages as $key=>$lang)
                        @if($lang->locale == app()->getLocale())
                            <a class="nav-link dropdown-toggle" id="dropdown-flag" href="javascript:void(0);"
                               data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                <img src="{{$lang->flag}}" class="img-fluid" style="width: 16px"><span
                                    class="selected-language">  {{app()->getLocale()}}</span></a>
                        @endif
                    @endforeach

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-flag">
                        @foreach($languages as $key=>$lang)
                            @if($lang->locale != app()->getLocale())
                                <a class="dropdown-item"
                                   href="{{LaravelLocalization::getLocalizedURL($lang->locale, null, [], true)}}"
                                   data-language="{{$lang->locale}}">
                                    <img src="{{$lang->flag}}" class="img-fluid" style="width: 16px"> {{$lang->code}}
                                </a>
                            @endif
                        @endforeach
                    </div>

                </li>
            </ul>
        </div>
        <ul class="nav navbar-nav align-items-center ml-auto">
            <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link"
                                                           id="dropdown-user" href="javascript:void(0);"
                                                           data-toggle="dropdown" aria-haspopup="true"
                                                           aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none"><span
                            class="user-name font-weight-bolder">John Doe</span><span class="user-status">Admin</span>
                    </div>
                    <span class="avatar"><img class="round"
                                              src="{{asset('./backend/app-assets/images/portrait/small/avatar-s-11.jpg')}}"
                                              alt="avatar" height="40" width="40"><span
                            class="avatar-status-online"></span></span></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">

                <a class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.index') }}">{{ __('Home') }}</a>
                </a>
                <a class="nav-item {{ request()->routeIs('profile') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('profile') }}">{{ __('Profile') }}</a>
                </a>
                    <a class="dropdown-item"
                       href="javascript:void(0);"><i
                            class="mr-50" data-feather="user"></i> Profile</a>
                    <a class="dropdown-item"
                                                                                 href="javascript:void(0);"><i
                            class="mr-50" data-feather="mail"></i> Inbox</a><a class="dropdown-item"
                                                                               href="javascript:void(0);"><i
                            class="mr-50" data-feather="check-square"></i> Task</a><a class="dropdown-item"
                                                                                      href="javascript:void(0);"><i
                            class="mr-50" data-feather="message-square"></i> Chats</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:void(0);"><i class="mr-50" data-feather="settings"></i>
                        Settings</a><a class="dropdown-item" href="javascript:void(0);"><i class="mr-50"
                                                                                           data-feather="credit-card"></i>
                        Pricing</a><a class="dropdown-item" href="javascript:void(0);"><i class="mr-50"
                                                                                          data-feather="help-circle"></i>
                        FAQ</a>
                    <a class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><i class="mr-50" data-feather="power"></i> Logout</a>
                    <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none">
                        @csrf
                    </form>

                </div>
            </li>
        </ul>
    </div>
</nav>
