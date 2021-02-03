<nav class="col-md-2 sidebar">
    <div class="user-box text-center pt-3 pb-3">
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

        <ul class="list-inline mb-2 sidebar_main_top_btn">
            <li class="list-inline-item">
                <a href="{{ route('profile') }}" title="@lang('app.my_profile')">
                    <!-- <i class="fas fa-cog"></i> -->Setting
                </a>
            </li>

            <li class="list-inline-item">
                <a href="{{ route('auth.logout') }}" class="text-custom" title="@lang('app.logout')">
                    <!-- <i class="fas fa-sign-out-alt"></i> -->Logout
                </a>
            </li>
        </ul>
    </div>

    <div class="sidebar-sticky new_sticky_sidebar_set">
        <ul class="nav flex-column">

            
            <div class="sidebar_item_set">
            	@if (Auth::user()->hasRole('Admin'))
	            	<li class="nav-item">
	                <a class="nav-link {{ Request::is('/') ? 'active' : ''  }}" href="{{ route('dashboard') }}">
	                    <i class="fas fa-home"></i>
	                    <span>@lang('app.dashboard')</span>
	                </a>
	            </li>
	            @else
	            <li class="nav-item">
	                <a class="nav-link {{ Request::is('users') ? 'active' : ''  }}" href="{{ route('dashboard') }}">
	                    <i class="fas fa-home"></i>
	                    <span>@lang('app.dashboard')</span>
	                </a>
	            </li>
	            @endif
            </div>
            
           
            	@if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('SuperAdmin'))
            	 <div class="sidebar_item_set">
	            <li class="nav-item">
	                <a class="nav-link {{ Request::is('category*') ? 'active' : ''  }}" href="{{ route('category') }}">
	                    <i class="fas fa-home"></i>
	                    <span>Video Category</span>
	                </a>
	            </li>
	          
	            <li class="nav-item">
	                <a class="nav-link {{ Request::is('subcat*') ? 'active' : ''  }}" href="{{ route('subcat') }}">
	                    <i class="fas fa-home"></i>
	                    <span>Video Sub Category</span>
	                </a>
	            </li>
	           
	            <li class="nav-item">
	                <a class="nav-link {{ Request::is('video*') ? 'active' : ''  }}" href="{{ route('video') }}">
	                    <i class="fas fa-home"></i>
	                    <span>Videos Listing</span>
	                </a>
	            </li>
	           
	            <li class="nav-item">
	                <a class="nav-link {{ Request::is('addvideo/create') ? 'active' : ''  }}" href="{{ route('videoadd.create') }}">
	                    <i class="fas fa-home"></i>
	                    <span>Add Video</span>
	                </a>
	            </li>
	             </div>
	            @endif

	            @if (Auth::user()->hasRole('Videomaker'))
            	 <div class="sidebar_item_set">
	           
	           
	            <li class="nav-item">
	                <a class="nav-link {{ Request::is('video*') ? 'active' : ''  }}" href="{{ route('video') }}">
	                    <i class="fas fa-home"></i>
	                    <span>Videos Listing</span>
	                </a>
	            </li>
	           
	            <li class="nav-item">
	                <a class="nav-link {{ Request::is('addvideo/create') ? 'active' : ''  }}" href="{{ route('videoadd.create') }}">
	                    <i class="fas fa-home"></i>
	                    <span>Add Video</span>
	                </a>
	            </li>
	             </div>
	            @endif
           
             
             
              <div class="sidebar_item_set">
              	 <li class="nav-item">
	                <a class="nav-link {{ Request::is('historyvideo*') ? 'active' : ''  }}" href="{{ route('videos.adminvideos') }}">
	                    <i class="fas fa-home"></i>
	                    <span>My Viewed Videos History</span>
	                </a>
	            </li>
	              @if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Videomaker'))
	             <li class="nav-item">
	                <a class="nav-link {{ Request::is('generalvideo*') ? 'active' : ''  }}" href="{{ route('videos.viewreport') }}">
	                    <i class="fas fa-home"></i>
	                    <span>General Viewed Report</span>
	                </a>
	            </li>
	              @endif
              </div>
          
	           	@permission('users.manage')
	           	 <div class="sidebar_item_set">
	            <li class="nav-item">
	                <a class="nav-link {{ Request::is('user*') ? 'active' : ''  }}" href="{{ route('user.list') }}">
	                    <i class="fas fa-users"></i>
	                    <span>Users Listing</span>
	                </a>
	            </li>
	           
	            <li class="nav-item">
	                <a class="nav-link {{ Request::is('adduser/create') ? 'active' : ''  }}" href="{{ route('user.create') }}">
	                    <i class="fas fa-users"></i>
	                    <span>Add User</span>
	                </a>
	            </li>
	            </div>
	            @endpermission
           
             	@if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('SuperAdmin'))
           <div class="sidebar_item_set">
	          
	            <li class="nav-item">
	                <a class="nav-link {{ Request::is('productcategory*') ? 'active' : ''  }}" href="{{ route('productcategory') }}">
	                    <i class="fas fa-home"></i>
	                    <span>Product Categories</span>
	                </a>
	            </li>
	           
	            <li class="nav-item">
	                <a class="nav-link {{ Request::is('product*') ? 'active' : ''  }}" href="{{ route('product') }}">
	                    <i class="fas fa-home"></i>
	                    <span>Product Listing</span>
	                </a>
	            </li>
	       
	            <li class="nav-item">
	                <a class="nav-link {{ Request::is('addproduct/create') ? 'active' : ''  }}" href="{{ route('product.create') }}">
	                    <i class="fas fa-home"></i>
	                    <span>Add Product</span>
	                </a>
	            </li>
	         
           </div>
              @endif	
            <div class="sidebar_item_set">
            	<li class="nav-item">
	                <a class="nav-link {{ Request::is('orders/myorder') ? 'active' : ''  }}" href="{{ route('myorder') }}">
	                    <i class="fas fa-users"></i>
	                    <span>My Orders </span>
	                </a>
	            </li>
	          
	         @if (Auth::user()->hasRole('Admin'))
            	<li class="nav-item">
	                <a class="nav-link {{ Request::is('orders') ? 'active' : ''  }}" href="{{ route('orders') }}">
	                    <i class="fas fa-users"></i>
	                    <span>All Orders </span>
	                </a>
	            </li>
	            @endif
	    
	         
	            <li class="nav-item">
	                <a class="nav-link " href="{{ route('earnpoint') }}">
	                    <i class="fas fa-sign-out-alt"></i>
	                    <span>My Wallet</span>
	                </a>
	            </li>
	            

	           <!--  @if (Auth::user()->hasRole('Videomaker'))
	            <li class="nav-item">
	                <a class="nav-link " href="{{ route('viewvideo') }}">
	                    <i class="fas fa-sign-out-alt"></i>
	                    <span>Viewed Videos</span>
	                </a>
	            </li>
	            @endif -->
	            @if (Auth::user()->hasRole('Advertiser') )
	            <li class="nav-item">
	                <a class="nav-link {{ Request::is('advertise*') ? 'active' : ''  }}" href="{{ route('advertise') }}">
	                    <i class="fas fa-home"></i>
	                    <span>Advertise Management</span>
	                </a>
	            </li>
	            @endif
            </div>
        <div class="sidebar_item_set">
        	 <li class="nav-item">
                <a class="nav-link " href="{{ route('home') }}">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Watch Videos</span>
                </a>
            </li>
        </div>

          
            
           
        
       
        
          
           
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

