@extends('layouts.adminapp')
@section('content')

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Appointment</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Appointment</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i>Barber shop
                  </h4>
                </div>
                <!-- /.col -->
              </div>


              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Service Name: {{$appointment->subservice->name}}</p>

                  <label for="">Description</label>

                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    {{$appointment->description}}
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Employee Assigned:</th>
                        <td>{{$appointment->employee_assigned->name ?? ""}}</td>
                      </tr>
                      <tr>
                        <th>Sub-service Selected:</th>
                        <td>{{$appointment->subservice->name}}</td>
                      </tr>
                      <tr>
                        <th>Status:</th>
                        <td>
                            @if ($appointment->status =="pending")

                            <span class="badge badge-warning"> Pending</span>

                            @elseif($appointment->status =="approved")
                            <span class="badge badge-primary"> Approved</span>
                            @elseif($appointment->status =="completed")
                            <span class="badge badge-success"> Approved</span>

                            @elseif ($appointment->status =="rejected")
                            <span class="badge badge-danger"> Rejected</span>


                            @endif

                        </td>
                      </tr>
                      <tr>
                        <th>Sub-service price:</th>
                        <td>Ksh: {{$appointment->subservice->price}}</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <div class="row no-print">
                <div class="col-12">

                    <div class="row">
                        @if ($appointment->status != 'completed')
                        <div class="div mr-4">
                            <form id="pay-form"
                                action="{{ route('payAppointment', $appointment) }}"
                                method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm  btn-warning"> {{
                                    __('Pay') }}</button>
                            </form>
                        </div>
                        @endif
                        @if ($appointment->status != 'completed' && auth()->user()->isManager())

                        <div class="div mr-4">
                            <form action="{{ route('approveAppointment', $appointment) }}"
                                method="POST">
                                <input type="hidden" name="status" value="approved">
                                @csrf
                                <button type="submit"
                                    class="btn btn-sm  btn-success">Approve</button>
                            </form>
                        </div>
                        <div class="div mr-4">
                            <form action="{{ route('approveAppointment', $appointment) }}"
                                method="POST">
                                <input type="hidden" name="status" value="rejected">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-secondary"> {{
                                    __('Reject') }}</button>
                            </form>

                        </div>
                        @endif
                    </div>
                  <a type="button" href="{{route('appointments.index')}}" class="btn btn-primary float-right" style="margin-right: 5px;">
                     Back
                  </a>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper --

@endsection
