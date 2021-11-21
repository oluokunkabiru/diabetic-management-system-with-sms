
<div class="navbar-bg"></div>

<!-- Start app top navbar -->
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
        </ul>
        {{--  <div class="search-element">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
            <div class="search-backdrop"></div>
            <div class="search-result">
                <div class="search-header">Histories</div>
                <div class="search-item">
                    <a href="#">How to Used HTML in Laravel</a>
                    <a href="#" class="search-close"><i class="fas fa-times"></i></a>
                </div>
            </div>
        </div>  --}}
    </form>

    <ul class="navbar-nav navbar-right">
        <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i><span class="text-danger font-weight-bold">
            {{ Auth::user()->unreadNotifications->count(); }}
        </span></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
            <div class="dropdown-header">Notifications
                <div class="float-right">
                    <a href="{{ route('mark-all-as-read') }}">Mark All As Read</a>
                </div>
            </div>
            <div class="dropdown-list-content dropdown-list-icons">
                @forelse (Auth::user()->unreadNotifications as $notification)
                <a href="{{ route('mark-as-read', $notification->id) }}" class="dropdown-item dropdown-item-unread">
                    <div class="dropdown-item-icon bg-primary text-white">
                        <i class="{{ $notification->data['icon'] ?$notification->data['icon']:"fas fa-code"  }}"></i>
                    </div>
                    <div class="dropdown-item-desc"> {{ $notification->data['message'] }}
                        <div class="time text-primary">{{ Auth::user()->timeago($notification->created_at) }}</div>
                    </div>
                </a>
                @empty
                <a href="#" class="dropdown-item dropdown-item-unread">
                    <div class="dropdown-item-icon bg-primary text-white">
                        <i class="fas fa-code"></i>
                    </div>
                    <div class="dropdown-item-desc text-danger"> No notification
                        {{-- <div class="time text-primary">2 Min Ago</div> --}}
                    </div>
                </a>
                @endforelse
 </div>
            <div class="dropdown-footer text-center">
                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
            </div>
            </div>
        </li>
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{ Auth::user()->getMedia('avatar')->first()?Auth::user()->getMedia('avatar')->first()->getFullUrl():asset('assets/users/assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">Hi, {{ ucwords(Auth::user()->name) }}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="" class="dropdown-item has-icon"><i class="fas fa-user"></i>New User</a>
                <a href="" class="dropdown-item has-icon"><i class="fas fa-barcode"></i>New GIFMIS</a>
                 <div class="dropdown-divider"></div>
                 {{--  @if ($role->hasPermissionTo("logout"))  --}}
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();" class="dropdown-item has-icon text-danger"><i class="fas fa-sign-out-alt"></i> Logout</a>
                {{--  @endif  --}}
        </div>
        </li>
    </ul>
</nav>

<!-- Start main left sidebar menu -->
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('index') }}"><img src="{{ appsettings()->getMedia('avatar')->first()?appsettings()->getMedia('avatar')->first()->getFullUrl():asset('assets/users/assets/img/avatar/avatar-1.png') }}" class="rounded-circle" style="width: 15%" alt="{{ appsettings()->name }}"></a>
        </div>

        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown active">
                <a href="{{ route('home') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>

            </li>


            {{--  @if ($role->hasPermissionTo("view users"))  --}}
            <li class="menu-header">Users</li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fa fa-users"></i> <span>Users</span></a>
                <ul class="dropdown-menu">
                     {{-- @if ($role->hasPermissionTo("add user")) --}}
                     <li><a href="{{ route('user-management.create') }}">Add users</a></li>
                    {{-- @endif --}}
                    {{-- @if ($role->hasPermissionTo("manage users")) --}}
                     <li><a href="{{ route('user-management.index') }}">Manage users</a></li>

                    {{-- @endif --}}

                </ul>
            </li>

            {{--  @if ($role->hasPermissionTo("view offence"))  --}}
            <li class="menu-header">Service</li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fa fa-car"></i> <span>Services</span></a>
                <ul class="dropdown-menu">
                     {{--  <li><a href="">Add motorcycle</a></li>  --}}
                     <li><a href="{{ route('courses.index') }}">Driving course Services</a></li>
                     <li><a href="{{ route('driver-licence-category') }}">Driver License</a></li>

                </ul>
            </li>
            {{--  @endif  --}}


            {{--  @if ($role->hasPermissionTo("view crimes list"))  --}}

            <li class="menu-header">Training</li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fa fa-road"></i> <span>Training</span></a>
                <ul class="dropdown-menu">
                     {{--  <li><a href="">Add motorcycle</a></li>  --}}
                    <li><a href="{{ route('training-center.index') }}">Manage training center</a></li>
                    <li><a href="{{ route('classes-schedule.index') }}">Training Schedule</a></li>
                    <li><a href="{{ route('pickup-point.index') }}">Pick up point</a></li>


                </ul>
            </li>
            {{--  @endif  --}}

            {{--  @if ($role->hasPermissionTo("view offence"))  --}}

            <li class="menu-header">Application</li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fa fa-graduation-cap"></i> <span>Application</span></a>
                <ul class="dropdown-menu">
                     {{--  <li><a href="">Add motorcycle</a></li>  --}}
                     <li><a href="{{ route('pending-application') }}">Pending Application </a></li>
                     <li><a href="{{ route('processing-application') }}">Processed application</a></li>
                     <li><a href="{{ route('active-application') }}">Active application</a></li>
                     <li><a href="{{ route('reject-application') }}">Rejected application</a></li>
                     <li><a href="{{ route('reject-application') }}">Graduate</a></li>
                     <li><a href="{{ route('driver-lincense-process.index') }}">Driver License Application</a></li>


                </ul>
            </li>

            <li class="menu-header">Quiz</li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fa fa-question"></i> <span>Quiz</span></a>
                <ul class="dropdown-menu">
                     {{--  <li><a href="">Add motorcycle</a></li>  --}}
                     <li><a href="">Processed</a></li>
                     <li><a href="">Processing</a></li>
                     <li><a href="">Pending</a></li>

                </ul>
            </li>





            {{--  @if ($role->hasPermissionTo("view permission"))  --}}
            <li class="menu-header">Permission</li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-lock"></i> <span>Permission and role</span></a>
                <ul class="dropdown-menu">
                    {{--  @if ($role->hasPermissionTo("view role"))  --}}
                    <li><a class="nav-link" href="{{ route('role.index') }}">Manage role</a></li>
                    {{--  @endif  --}}
                    {{--  @if ($role->hasPermissionTo("manage permission"))  --}}

                    <li><a class="nav-link" href="{{ route('permission.index') }}">Manage permission</a></li>
                     {{--  @endif  --}}
                </ul>
            </li>
            {{--  @endif  --}}

            {{--  @if ($role->hasPermissionTo("view setting"))  --}}
            <li class="menu-header">Settings</li>
            <li class="dropdown">
                <a href="{{ route('settings.index') }}" class="nav-link has-dropdow"><i class="fas fa-cog"></i> <span>Settings</span></a>

            </li>
            {{--  @endif  --}}






             </ul>

    </aside>
</div>
