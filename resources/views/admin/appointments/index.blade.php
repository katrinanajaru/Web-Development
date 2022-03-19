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
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-3 order-2 order-md-1">
                        <div class="row">
                            <div class="col-12">
                                <h4>Recent Appointments</h4>
                                @foreach ($appointments as $appointment)
                                <div class="post">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm"
                                            src="{{ asset('/admin/dist/img/user1-128x128.jpg') }}" alt="user image">
                                        <span class="username">
                                            <a href="#">{{ $appointment->user->name }}</a>
                                        </span>
                                        <span class="description">Sent on {{ $appointment->created_at }}</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <p>
                                        {{ Str::limit($appointment->description, 15) }}
                                    </p>

                                    <p>
                                        <a href="{{ route('appointments.show', $appointment->id) }}"
                                            class="link-black text-sm"><i class="fas fa-link mr-1"></i> Read
                                            more...</a>
                                    </p>

                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-9 order-1 order-md-2">
                        <!-- Main row -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Appointments Table</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>User</th>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($appointmenttabless as $appointment)
                                        <tr>
                                            <td>{{ $appointment->user->name }}</td>
                                            <td>{{ $appointment->subservice->name }}</td>
                                            <td>{{ $appointment->date }}</td>
                                            <td>{{ $appointment->status }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="div mr-4">
                                                        <a href="{{ route('appointments.show', $appointment->id) }}"
                                                            class="btn btn-sm btn-info"> <i class="fa fa-eye"
                                                                aria-hidden="true"></i> View</a>
                                                    </div>
                                                    @if ($appointment->status != 'completed')
                                                    <div class="div mr-4">
                                                        <form id="pay-form"
                                                            action="{{ route('payAppointment', $appointment) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm  btn-info"> {{
                                                                __('Pay') }}</button>
                                                        </form>
                                                    </div>
                                                    @endif
                                                    @if ($appointment->status != 'completed')

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
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>User</th>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
</div>
@endsection
