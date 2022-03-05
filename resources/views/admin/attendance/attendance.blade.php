@extends('layouts.adminapp')
@section('content')

<section class="content">
    <div  class="content-wrapper" >

        <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1>Employees Attendance List</h1>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Employees Attendance</li>
                  </ol>
                </div>
              </div>
            </div><!-- /.container-fluid -->
          </section>

          <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12">
                    <table id="example1" class="table table-hover table-inverse ">
                        <thead class="thead-inverse">
                            <tr>
                                <th>Employee</th>
                                <th>Time In</th>
                                <th>Time out </th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendances as $attendance)
                                <tr>
                                    <td scope="row"> {{ $attendance->employee->name}} </td>
                                    <td> {{ $attendance->arrived_time }} </td>
                                    <td> {{ $attendance->leave_time }} </td>
                                    <td>
                                        <a href="#" class="btn btn-primary" > <i class="fa fa-eye" aria-hidden="true"></i> </a>
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
