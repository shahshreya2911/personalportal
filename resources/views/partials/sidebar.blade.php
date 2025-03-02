<nav class="col-md-2 sidebar">
    <div class="user-box text-center pt-5 pb-3">
        <div class="user-img">
            <img src="{{ auth()->user()->present()->avatar }}"
                 width="90"
                 height="90"
                 alt="user-img"
                 class="rounded-circle img-thumbnail img-responsive">
        </div>
        <h5 class="my-3">
            <a href="{{ route('profile') }}">{{ auth()->user()->present()->nameOrEmail }}</a>
        </h5>

        <ul class="list-inline mb-2">
            <li class="list-inline-item">
                <a href="{{ route('profile') }}" title="@lang('app.my_profile')">
                    <i class="fas fa-cog"></i>
                </a>
            </li>

            <li class="list-inline-item">
                <a href="{{ route('auth.logout') }}" class="text-custom" title="@lang('app.logout')">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </li>
        </ul>
    </div>

    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            @if (Auth::user()->hasRole('Admin'))
            <li class="nav-item">
                <a class="nav-link {{ Request::is('/') ? 'active' : ''  }}" href="{{ route('dashboard') }}">
                    <i class="fas fa-home"></i>
                    <span>@lang('app.dashboard')</span>
                </a>
            </li>
            
            @endif

            @if (Auth::user()->hasRole('User'))
            <li class="nav-item">
                <a class="nav-link {{ Request::is('/') ? 'active' : ''  }}" href="{{ route('dashboard') }}">
                    <i class="fas fa-home"></i>
                    <span>User Dashboard</span>
                </a>
            </li>
          
            @endif            
           
            @permission('users.manage')
            <li class="nav-item">
                <a class="nav-link {{ Request::is('user*') ? 'active' : ''  }}" href="{{ route('user.list') }}">
                    <i class="fas fa-users"></i>
                    <span>@lang('app.users')</span>
                </a>
            </li>
            @endpermission
            
       
            
           
         <!--   @if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('SuperAdmin'))
            <li class="nav-item">
                <a class="nav-link {{ Request::is('zone*') ? 'active' : ''  }}" href="{{ route('zone') }}">
                    <i class="fas fa-home"></i>
                    <span>Zones</span>
                </a>
            </li>
            @endif
          @if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('SuperAdmin'))
            <li class="nav-item">
                <a class="nav-link {{ Request::is('product*') ? 'active' : ''  }}" href="{{ route('product') }}">
                    <i class="fas fa-home"></i>
                    <span>Products</span>
                </a>
            </li>
            @endif
            @if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('SuperAdmin'))
            <li class="nav-item">
                <a class="nav-link {{ Request::is('job*') ? 'active' : ''  }}" href="{{ route('job') }}">
                    <i class="fas fa-home"></i>
                    <span>Jobs</span>
                </a>
            </li>
            @endif
            @if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('SuperAdmin'))
            <li class="nav-item">
                <a class="nav-link {{ Request::is('stockin*') ? 'active' : ''  }}" href="{{ route('stockin') }}">
                    <i class="fas fa-home"></i>
                    <span>StockIn</span>
                </a>
            </li>
            @endif
            @if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('SuperAdmin'))
            <li class="nav-item">
                <a class="nav-link {{ Request::is('stockout*') ? 'active' : ''  }}" href="{{ route('stockout') }}">
                    <i class="fas fa-home"></i>
                    <span>StockOut</span>
                </a>
            </li>
            @endif
             @if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('SuperAdmin'))
            <li class="nav-item">
                <a class="nav-link {{ Request::is('report*') ? 'active' : ''  }}" href="{{ route('report') }}">
                    <i class="fas fa-home"></i>
                    <span>Reports</span>
                </a>
            </li>
            @endif 
            @permission('users.activity')
            <li class="nav-item">
                <a class="nav-link {{ Request::is('activity*') ? 'active' : ''  }}" href="{{ route('activity.index') }}">
                    <i class="fas fa-server"></i>
                    <span>@lang('app.activity_log')</span>
                </a>
            </li>
            @endpermission-->
           
            <!-- @if (Auth::user()->hasRole('Admin'))
             <li class="nav-item">
                <a class="nav-link {{ Request::is('questions*') ? 'active' : ''  }}" href="{{ route('questions') }}">
                    <i class="fas fa-users"></i>
                    <span>Questions</span>
                </a>
            </li>
            @endif -->
           
            <!--  <li class="nav-item">
                <a class="nav-link {{ Request::is('choices*') ? 'active' : ''  }}" href="{{ route('choices') }}">
                    <i class="fas fa-users"></i>
                    <span>Choices</span>
                </a>
            </li> -->
           <!--  @permission(['roles.manage', 'permissions.manage'])
            <li class="nav-item">
                <a href="#roles-dropdown"
                   class="nav-link"
                   data-toggle="collapse"
                   aria-expanded="{{ Request::is('role*') || Request::is('permission*') ? 'true' : 'false' }}">
                    <i class="fas fa-users-cog"></i>
                    <span>@lang('app.roles_and_permissions')</span>
                </a>
                <ul class="{{ Request::is('role*') || Request::is('permission*') ? '' : 'collapse' }} list-unstyled sub-menu" id="roles-dropdown">
                    @permission('roles.manage')
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('role*') ? 'active' : '' }}"
                           href="{{ route('role.index') }}">@lang('app.roles')</a>
                    </li>
                    @endpermission
                    @permission('permissions.manage')
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('permission*') ? 'active' : '' }}"
                           href="{{ route('permission.index') }}">@lang('app.permissions')</a>
                    </li>
                    @endpermission
                </ul>
            </li>
            @endpermission -->

           <!--  @permission(['settings.general', 'settings.auth', 'settings.notifications'], false)
            <li class="nav-item">
                <a href="#settings-dropdown"
                   class="nav-link"
                   data-toggle="collapse"
                   aria-expanded="{{ Request::is('settings*') ? 'true' : 'false' }}">
                    <i class="fas fa-cogs"></i>
                    <span>@lang('app.settings')</span>
                </a>
                <ul class="{{ Request::is('settings*') ? '' : 'collapse' }} list-unstyled sub-menu"
                    id="settings-dropdown">

                    @permission('settings.general')
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('settings') ? 'active' : ''  }}"
                           href="{{ route('settings.general') }}">
                            @lang('app.general')
                        </a>
                    </li>
                    @endpermission

                    @permission('settings.auth')
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('settings/auth*') ? 'active' : ''  }}"
                           href="{{ route('settings.auth') }}">@lang('app.auth_and_registration')</a>
                    </li>
                    @endpermission

                    @permission('settings.notifications')
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('settings/notifications*') ? 'active' : ''  }}"
                           href="{{ route('settings.notifications') }}">@lang('app.notifications')</a>
                    </li>
                    @endpermission
                </ul>
            </li>
            @endpermission -->
        </ul>
    </div>
</nav>

