<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('home')}}" class="brand-link">
        <img src="{{asset('/storage/profile/'. auth()->user()->image)}}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{config('app.name')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <a href="{{route('users.show',Auth::user()->id)}}">
                <img src="{{asset('/storage/profile/'. auth()->user()->image)}}" class="img-circle elevation-2"
                    alt="User Image">
                </a>

            </div>

            <div class="info">
                <a href="{{route('users.show',Auth::User()->id)}}" class="d-block">{{Auth::user()->name}}</a>
            </div>
            <span class="float-right text-sm text-success"><i >online</i></span>

        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Appointments
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('appointments.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View appointments</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('appointments.create')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Make appointment</p>
                            </a>
                        </li>

                    </ul>
                </li>
                {{-- services --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Services
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('services.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Services</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('services.create')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Services</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- end of services --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tree"></i>
                        <p>
                            Sub-Services
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('subservices.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View sub-services</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('subservices.create')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Sub-service</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>

                        <p>
                            Attendance
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('attendance.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('attendance.create')}}" class="nav-link">
                                <i class="fa fa-plus nav-icon" aria-hidden="true"></i>
                                <p>Attendance</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">

                        <i class="fa fa-users" aria-hidden="true"></i>
                        <p>
                            Users
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('users.index')}}" class="nav-link">
                                <i class="fa fa-users" aria-hidden="true"></i>
                                <p>View Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('users.create') }}" class="nav-link">
                                <i class="fa fa-user-plus" aria-hidden="true"></i>
                                <p>Add User</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">

                        <i class="fa fa-google-wallet" aria-hidden="true"></i>
                        <p>
                            Wallet
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('wallet.index')}}" class="nav-link">
                                <i class="fa fa-money" aria-hidden="true"></i>
                                <p>View </p>
                            </a>
                        </li>


                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">

                        <i class="fa fa-google-wallet" aria-hidden="true"></i>
                        <p>
                            Billings
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('billings.index')}}" class="nav-link">
                                <i class="fa fa-money" aria-hidden="true"></i>
                                <p>View </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('billings.create')}}" class="nav-link">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                <p>Create </p>
                            </a>
                        </li>


                    </ul>
                </li>



            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
