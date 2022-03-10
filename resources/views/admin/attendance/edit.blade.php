@extends('layouts.adminapp')
@section('content')
    <section class="content">
        <div class="content-wrapper">

            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Report your leave time from Work {{ date("d/m/Y") }}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Employee Attendance</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->

                <div class="row">
                    @if (session('success'))
                        <div class="alert alert-success col-12 text text-center" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                        <form action="{{route('attendance.update',$attendance)}}" class="col-md-6 offset-3 justify-center align-items-center" method="post">
                            <input type="hidden" name="employee_id" value="{{auth()->user()->id}}">
                            @csrf
                            @method("PUT")
                            <div class="form-group">
                                <label for="leave_time">Select your Leave time</label>
                                <input id="leave_time" class="form-control" type="time" name="leave_time">
                                <button type="submit" class="btn btn-primary btn-block mt-2">Submit</button>
                            </div>

                        </form>



                </div>
                <!-- /.row -->
                <!-- Main row -->

                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->

        </div>

    </section>
@endsection
