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

                        <!--Users-->
                        <li class="treeview">
                          <a href="#">
                            <i class="fa fa-user-circle-o"></i>
                            <span>User</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                          </a>
                          <ul class="treeview-menu">
                            <li><a href="{{ route('admin.users.index') }}"><i class="fa fa-circle-o"></i> List Users</a></li>
                            <li><a href="{{ route('admin.users.create') }}"><i class="fa fa-circle-o"></i> Add User</a></li>
                          </ul>
                        </li>

                        <!--Hosts-->
                        <li class="treeview">
                          <a href="#">
                            <i class="fa fa-map-marker"></i>
                            <span>Host</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                          </a>
                          <ul class="treeview-menu">
                            <li><a href="{{ route('admin.hosts.index') }}"><i class="fa fa-circle-o"></i> List Hosts</a></li>
                            <li><a href="{{ route('admin.hosts.create') }}"><i class="fa fa-circle-o"></i> Add Host</a></li>
                          </ul>
                        </li>

                        <!--Service Loctions-->
                        <li class="treeview">
                          <a href="#">
                            <i class="fa fa-map-marker"></i>
                            <span>Service Location</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                          </a>
                          <ul class="treeview-menu">
                            <li><a href="{{ route('admin.locations.index') }}"><i class="fa fa-circle-o"></i> List Service Locations</a></li>
                            <li><a href="{{ route('admin.locations.create') }}"><i class="fa fa-circle-o"></i> Add Service Locations</a></li>
                          </ul>
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