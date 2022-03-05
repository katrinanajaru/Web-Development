@extends('layouts.adminapp')
@section('content')
    <section class="content">
        <div class="content-wrapper">

            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Mark Employees Attendance For {{ date("d/m/Y") }}</h1>
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
                    <div class="col-md-12">
                        <table id="example1" class="table table-hover table-inverse ">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>Employee</th>
                                    <th>Time In</th>
                                    <th>Time out </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td scope="row"> {{ $employee->name }} </td>

                                        <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                data-target="{{ '#model-' . $employee->id }}">
                                                Time In
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="{{ 'model-' . $employee->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"> Time In for {{ $employee->name }}
                                                            </h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{route('attendance.store')}}" method="post">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label for="timein">Time in</label>
                                                                    <input type="hidden" name="employee_id"
                                                                        value="{{ $employee->id }}">
                                                                    <input id="arrived_time" class="form-control" type="time"
                                                                        name="arrived_time">
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>


                                        </td>



                                        <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                data-target="{{ '#model-' . $employee->id }}">
                                                Time out
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="{{ 'model-' . $employee->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"> Time Out for {{ $employee->name }}
                                                            </h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{route('attendance.store')}}" method="post">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label for="timein">Time Out</label>
                                                                    <input type="hidden" name="employee_id"
                                                                        value="{{ $employee->id }}">
                                                                    <input id="leave_time" class="form-control" type="time"
                                                                        name="leave_time">
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>


                                        </td>





                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.row -->
                <!-- Main row -->

                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->

        </div>

    </section>
@endsection
