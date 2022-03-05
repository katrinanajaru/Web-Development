@extends('layouts.adminapp')
@section('content')

<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Main row -->
            <div class="row">
                {{-- data --}}
                <!-- /.card -->

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Services Offered</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($services as $service)
                                <tr>
                                    <td>{{$service->name}}</td>
                                    <td>{{$service->amount}}</td>
                                    <td>{{Str::limit($service->description),1}}</td>
                                    <td>
                                        <div class="row">
                                            <div class="div">
                                                <a href="#" class="btn btn-sm btn-info">View</a>
                                            </div>
                                            <div>
                                                <a href="" class="btn btn-sm btn-warning">Edit</a>
                                            </div>
                                            <div class="div">
                                                <a href="#" class="btn btn-sm btn-danger">Delete</a>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

@endsection
