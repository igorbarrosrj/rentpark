<!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li> <a class="waves-effect waves-dark" href="/admin" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Dashboard</span></a>
                        </li>
                        <li class="treeview">
                          <a href="#">
                            <i class="fa fa-user-circle-o"></i>
                            <span>Provider</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                          </a>
                          <ul class="treeview-menu">
                            <li><a href="{{ route('admin.providers.index')}}"><i class="fa fa-circle-o"></i> List Providers</a></li>
                            <li><a href="{{ route('admin.providers.create')}}"><i class="fa fa-circle-o"></i> Add Provider</a></li>
                          
                          </ul>
                        </li>
                        <li class="treeview">
                          <a href="#">
                            <i class="fa fa-user-circle-o"></i>
                            <span>User</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                          </a>
                          <ul class="treeview-menu">

                            <li><a href="/listusers"><i class="fa fa-circle-o"></i> List Users</a></li>
                            <li><a href="/addusers"><i class="fa fa-circle-o"></i> Add User</a></li>

                            <li><a href="{{ route('admin.service_locations.index') }}"><i class="fa fa-circle-o"></i> List Service Locations</a></li>
                            <li><a href="{{ route('admin.service_locations.create') }}"><i class="fa fa-circle-o"></i> Add Service Locations</a></li>

                          </ul>
                        </li>

                        <!-- Booking Management -->

                         <li> <a class="waves-effect waves-dark" href="{{ route('admin.bookings.index') }}" aria-expanded="false"><i class="fa fa-calendar-check-o"></i><span class="hide-menu">Bookings</span></a>
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