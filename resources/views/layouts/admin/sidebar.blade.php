<!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">

                        <!-- Dashboard -->
                        <li> <a class="waves-effect waves-dark" href="/admin" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Dashboard</span></a>
                        </li>

                        <!-- Users -->
                        <li class="treeview">
                          <a href="#">
                            <i class="fa fa-user"></i>
                            <span>Users</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                          </a>
                          <ul class="treeview-menu">
                            <li><a href="{{ route('admin.users.index') }}"><i class="fa fa-circle-o"></i> List Users</a></li>
                            <li><a href="{{ route('admin.users.create') }}"><i class="fa fa-circle-o"></i> Add User</a></li>
                          </ul>
                        </li>

                        <!-- Providers -->
                        <li class="treeview">
                          <a href="#">
                            <i class="fa fa-users"></i>
                            <span>Providers</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                          </a>
                          <ul class="treeview-menu">
                            <li><a href="{{ route('admin.providers.index')}}"><i class="fa fa-circle-o"></i> List Providers</a></li>
                            <li><a href="{{ route('admin.providers.create')}}"><i class="fa fa-circle-o"></i> Add Provider</a></li>
                          
                          </ul>
                        </li>

                        <!--Service Loctions-->
                        <li class="treeview">
                          <a href="#">
                            <i class="fa fa-map-marker"></i>
                            <span>Service</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            <span style="padding-left: 43px;">Locations</span>
                            
                          </a>
                          <ul class="treeview-menu">
                            <li><a href="{{ route('admin.service_locations.index') }}"><i class="fa fa-circle-o"></i> List Service Locations</a></li>
                            <li><a href="{{ route('admin.service_locations.create') }}"><i class="fa fa-circle-o"></i> Add Service Locations</a></li>

                          </ul>
                        </li>

                        <!-- Hosts -->
                        <li class="treeview">
                          <a href="#">
                            <i class="fa fa-home"></i>
                            <span>Hosts</span>
                            
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                          </a>
                          <ul class="treeview-menu">
                             <li><a href="{{ route('admin.hosts.index') }}"><i class="fa fa-circle-o"></i> List Hosts</a></li>
                             <li><a href="{{ route('admin.hosts.create') }}"><i class="fa fa-circle-o"></i> Add Host</a></li>
                          </ul>
                        </li>

                        <!-- Booking Management -->

                         <li> <a class="waves-effect waves-dark" href="{{ route('admin.bookings.index') }}" aria-expanded="false"><i class="fa fa-calendar-check-o"></i><span class="hide-menu">Bookings</span></a>
                        </li>

                        <!-- Settings -->

                         <li> <a class="waves-effect waves-dark" href="{{ route('admin.settings.index') }}" aria-expanded="false"><i class="fa fa-gear"></i><span class="hide-menu">Settings</span></a>
                        </li>
                       

                       <!-- Profile -->

                         <li> <a class="waves-effect waves-dark" href="{{ route('admin.profile.view', Auth()->user()->id) }}" aria-expanded="false"><i class="fa fa-user-circle-o"></i><span class="hide-menu">Profile</span></a>
                        </li>

                        <!-- Logout -->

                         <li> <a class="waves-effect waves-dark" href="{{ route('admin.logout')}}" aria-expanded="false" onclick="confirm('Are you sure want to logout?');event.preventDefault();
                                                 document.getElementById('logout-form').submit();" ><i class="fa fa-sign-out"></i><span class="hide-menu">Logout</span></a>\

                          <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                        </li>

                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->