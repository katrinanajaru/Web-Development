<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('home')}}" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Profile Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">

          {{-- <img src="{{asset('/admin/dist/img/user1-128x128.jpg')}} " height="35px" alt="User Avatar" class="img-circle"> --}}
          <img src="{{ auth()->user()->image }} " height="35px" alt="User Avatar" class="img-circle">

        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{auth()->user()->image}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body"> <br>
                <h3 class="dropdown-item-title">
                  {{Auth::user()->name}}
                  <span class="float-right text-sm text-success"><i >online</i></span>
                </h3>
                <div class="text text-primary" >
                    @if (Str::lower( $user->role )  == "client")
                                        USER
                                    @else
                                    {{ $user->role }}
                                    @endif
                </div>

                <div>
                    <a href="{{route('users.show',Auth::User()->id)}}" class="text-sm mt-4 btn btn-sm" >View Profile</a>
                </div>


                <a class="dropdown-item dropdown-footer btn btn-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
              </div>
            </div>
            <!-- Message End -->
        </div>
      </li>
    </ul>
  </nav>
