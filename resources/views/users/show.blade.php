@extends('layouts.adminapp')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Profile</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">User Profile</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ $user->image }}" alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center">{{ $user->name }}</h3>

                                <p class="text-muted text-center">

                                    @if (Str::lower( $user->role )  == "client")
                                        USER
                                    @else
                                    {{ $user->role }}
                                    @endif
                                </p>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Phone</b> <a class="float-right">{{ $user->phone }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Email</b> <a class="float-right">{{ $user->email }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Member</b> <a
                                            class="float-right">{{ $user->created_at->format('d/m/Y') }}</a></a>
                                    </li>
                                </ul>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- About Me Box -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Settings</h3>
                            </div>
                            <!-- /.card-header -->

                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#activity"
                                            data-toggle="tab">Activity</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#timeline"
                                            data-toggle="tab">Payments</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#settings"
                                            data-toggle="tab">Settings</a></li>
                                    @if (auth()->user()->isEmployee() ||
    auth()->user()->isManager())
                                        <li class="nav-item"><a class="nav-link" href="#attendance"
                                                data-toggle="tab">attendance</a></li>
                                    @endif

                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="activity">
                                        {{-- Activity --}}
                                        <div class="row">

                                            <table class="table table-striped table-inverse ">
                                                <thead class="thead-inverse">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Service</th>
                                                        <th>Appointment</th>
                                                        <th>Status</th>
                                                        <th>Assigned</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($user->appointments->take(5) as $key => $appointment)
                                                        <tr>
                                                            <td scope="row"> {{ $key++ }} </td>
                                                            <td> {{ $appointment->service->name ?? '' }} </td>
                                                            <td>{{ $appointment->date }} </td>
                                                            <td>{{ $appointment->status }} </td>

                                                            <td>{{ $appointment->employee_assigned->name ?? 'N/A' }}
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('appointments.show', $appointment) }}"
                                                                    class="btn btn-primary"> <i class="fa fa-eye"
                                                                        aria-hidden="true"></i> </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach



                                                </tbody>
                                            </table>
                                            <div> <a href="#" class="btn btn-primary btn-block">View More</a> </div>



                                        </div>


                                        {{-- End Of activity --}}

                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="timeline">
                                        <!-- The timeline -->

                                        <table class="table table-striped table-inverse ">
                                            <thead class="thead-inverse">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Service</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                    <th>Amount</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($user->payments->take(5) as $key => $payment)
                                                    <tr>
                                                        <td scope="row"> {{ $key++ }} </td>
                                                        <td> {{ $payment->subService->name }} </td>
                                                        <td>{{ $payment->responseCode }} </td>
                                                        <td> {{ $payment->transactionDate }} </td>

                                                        <td>{{ $payment->amount }} </td>
                                                        <td>
                                                            <a href="#" class="btn btn-primary"> <i class="fa fa-eye"
                                                                    aria-hidden="true"></i> </a>
                                                        </td>
                                                    </tr>
                                                @endforeach



                                            </tbody>
                                        </table>
                                        <div> <a href="#" class="btn btn-primary btn-block">View More</a> </div>

                                    </div>
                                    <!-- /.tab-pane -->

                                    <div class="tab-pane" id="settings">
                                        <form method="POST" action="{{ route('users.update', $user) }}"
                                            enctype="multipart/form-data" class="form-horizontal">
                                            @method("PUT")
                                            @csrf
                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                                <div class="col-sm-10">
                                                    <input id="name" type="text"
                                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                                        value="{{ $user->name }}" required autocomplete="name" autofocus>
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="email" class="col-sm-2 col-form-label">Email <span
                                                        class="text text-danger h3">*</span></label>
                                                <div class="col-sm-10">
                                                    <input id="email" type="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        name="email" value="{{ $user->email }}" required
                                                        autocomplete="email" autofocus>
                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="phone" class="col-sm-2 col-form-label">Phone <span
                                                        class="text text-danger h3">*</span></label>
                                                <div class="col-sm-10">
                                                    <input id="phone" type="text"
                                                        class="form-control @error('phone') is-invalid @enderror"
                                                        name="phone" value="{{ $user->phone }}" required
                                                        autocomplete="phone" autofocus>
                                                    @error('phone')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="image" class="col-sm-2 col-form-label">Your Image</label>
                                                <div class="col-sm-10">
                                                    <input id="image" type="file"
                                                        class="form-control @error('image') is-invalid @enderror"
                                                        name="image" value="{{ old('image') }}" autocomplete="image"
                                                        autofocus>
                                                    @error('image')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="current_password" class="col-sm-2 col-form-label">Current
                                                    Password <span class="text text-danger h3">*</span> </label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="current_password" class="form-control"
                                                        id="current_password" placeholder="current_password">
                                                    @if (session('error'))
                                                        <span class="text text-danger"> {{ session('error') }} </span>
                                                    @endif

                                                    @error('current_password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="offset-sm-2 col-sm-10">
                                                    <button type="submit" class="btn btn-danger">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    @if (auth()->user()->isEmployee() ||auth()->user()->isManager())
                                        <div class="tab-pane" id="attendance">

                                            <table class="table table-striped table-inverse">
                                                <thead class="thead-inverse">
                                                    <tr>
                                                        <th>Time In</th>
                                                        <th>Time Out</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($user->attedances->take(5) as $attedance)
                                                        <tr>
                                                            <td scope="row"> {{ $attedance->arrived_time }} </td>
                                                            <td>{{ $attedance->leave_time }} </td>
                                                            <td> <a href="#" class="btn btn-primary"> <i
                                                                        class="fa fa-eye" aria-hidden="true"></i> </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach


                                                </tbody>

                                            </table>
                                            <a class="btn btn-primary btn-block" href="#"> View More </a>
                                        </div>
                                    @endif



                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
