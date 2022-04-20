@extends('layouts.adminapp')
@section('content')

<section class="content">
    <div  class="content-wrapper" >

        <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1>Employee Attendance List</h1>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Employee Attendance</li>
                  </ol>
                </div>
              </div>
            </div><!-- /.container-fluid -->
          </section>

          <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                    <div class="card col-12">
                        <div class="card-body ">

                            <table class="table table-hover table-inverse ">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th>Employee</th>
                                        <th>Time In</th>
                                        <th>Time out </th>
                                        @if (Auth()->user()->isManager())
                                            <th>Action</th>
                                        @endif

                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($attendances as $attendance)

                                        <tr>
                                            <td > {{ $attendance->employee->name}} </td>
                                            <td> {{ $attendance->arrived_time ." => ". $attendance->created_at  }} </td>
                                            <td>
                                                @if ($attendance->leave_time == "")
                                                <span class="badge badge-pill badge-warning">Sign Out</span>

                                                @else
                                                    {{  $attendance->leave_time  ." => ". $attendance->updated_at }}
                                                @endif
                                                 </td>


                                                @if (Auth()->user()->isManager())
                                                <td>

                                                    <a href="#" class="btn btn-danger"  onclick="event.preventDefault();
                                                document.getElementById('delete_attendance').submit();" > <i class="fa fa-trash" aria-hidden="true"></i> </a>

                                                <form action=" {{route('attendance.destroy',$attendance)}} " id="delete_attendance" method="post">
                                                    @method("DELETE")
                                                    @csrf
                                                </form>
                                            </td>

                                                @endif





                                        </tr>

                                        @endforeach



                                    </tbody>


                            </table>
                            {{ $attendances->links()  }}


                        </div>
                    </div>

            </div>
            <!-- /.row -->
            <!-- Main row -->

            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->

    </div>

</section>

@endsection
