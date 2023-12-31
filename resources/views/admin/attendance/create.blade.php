@extends('layouts.adminapp')
@section('content')
    <section class="content">
        <div class="content-wrapper">

            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Report to Work {{ date("d/m/Y") }}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Employees Attendance</li>
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

                        <form action="{{route('attendance.store')}}" class="col-md-6 offset-3 justify-center align-items-center" method="post">
                            <input type="hidden" name="employee_id" value="{{auth()->user()->id}}">
                            @csrf
                            <div class="form-group">
                                <label for="arrived_time">Select your arrive time</label>
                                <input id="arrived_time" class="form-control" type="time" name="arrived_time">
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
