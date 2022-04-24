@extends('layouts.adminapp')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Services</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Appointments </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Appointment Details</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>



                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Name</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($appointmenttabless as $appointment)
                                        <tr>
                                            <td>{{ $appointment->user->name ?? '' }}</td>
                                            <td>{{ $appointment->subservice->name }}</td>
                                            <td>{{ $appointment->date }}</td>
                                            <td>{{ number_format($appointment->subservice->price, 2) }} </td>
                                            <td class="text text-bold h3" >

                                                @switch($appointment->status)
                                                    @case("approved")
                                                        <span class="badge badge-primary">Approved</span>
                                                        @break
                                                    @case("completed")
                                                    <span class="badge badge-info">Completed</span>
                                                        @break
                                                        @case(2)

                                                        @break
                                                        @case("rejected")
                                                        <span class="badge badge-danger">rejected</span>
                                                            @break
                                                            @case(2)

                                                            @break

                                                    @default
                                                    <span class="badge badge-secondary">{{ $appointment->status }}</span>
                                                @endswitch


                                            </td>
                                            <td class="row">

                                                <div class="col-md-4">
                                                    <a href="{{ route('appointments.show', $appointment->id) }}"
                                                        class="btn btn-sm btn-info"> <i class="fa fa-eye"
                                                            aria-hidden="true"></i> </a>
                                                </div>
                                                @if ($appointment->status != 'completed' && Auth::user()->isClient())
                                                    {{-- Pay --}}
                                                    <div class="col-md-4">
                                                        <form id="pay-form"
                                                            action="{{ route('payAppointment', $appointment) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm  btn-info">
                                                                {{                                                                         __('Pay') }}</button>
                                                        </form>
                                                    </div>
                                                @endif
                                                @if ($appointment->status != 'completed' && auth()->user()->isManager())
                                                    <div class="col-md-4">
                                                        <form
                                                            action="{{ route('approveAppointment', $appointment) }}"
                                                            method="POST">
                                                            <input type="hidden" name="status" value="approved">
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-sm  btn-success">Approve</button>
                                                        </form>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <form
                                                            action="{{ route('approveAppointment', $appointment) }}"
                                                            method="POST">
                                                            <input type="hidden" name="status" value="rejected">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-secondary">
                                                                {{                                                                         __('Reject') }}</button>
                                                        </form>
                                                    </div>
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>

                                        <tr>
                                            <th>User</th>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>

                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->


                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
    </div>
@endsection
