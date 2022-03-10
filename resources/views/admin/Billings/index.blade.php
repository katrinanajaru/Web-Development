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
                    <h3 class="card-title">Billings Details</h3>

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
                                    <table id="example1" class="table table-bordered table-striped ">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Amount</th>
                                                <th>Created BY</th>
                                                <th>Confirmed By</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($billings as $billing)
                                                <tr>
                                                    <td>{{ $billing->name}}</td>
                                                    <td>{{ $billing->amount }}</td>
                                                    <td>{{ $billing->createdBy->name ?? "" }}</td>
                                                    <td>{{ $billing->confirmedBy->name ?? "Not Yet" }}</td>
                                                    <td>{{ Str::of($billing->status)->limit(55)->upper()  }}</td>
                                                    <td>
                                                        <div class="row">


                                                            <!-- Button trigger modal -->
                                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="{{"#modelId".$billing->id}}">
                                                              <i class="fa fa-eye" aria-hidden="true"></i>

                                                            </button>

                                                            <!-- Modal -->
                                                            <div class="modal fade" id="{{"modelId".$billing->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">{{$billing->name}}</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>
                                                                                {{ $billing->reason }}
                                                                            </p>
                                                                            <div class="row" >
                                                                                <form class="col-md-4" action="{{route('billings.update',$billing)}}" method="post">
                                                                                    <input type="hidden" name="status" value="approved">
                                                                                    @csrf
                                                                                    @method("PUT")
                                                                                    <button type="submit" class="btn btn-primary">Approve</button>
                                                                                </form>
                                                                                @if ($billing->status != "rejected")
                                                                                <form class="col-md-4" action="{{route('billings.update',$billing)}}" method="post">
                                                                                    <input type="hidden" name="status" value="rejected">
                                                                                    @csrf
                                                                                    @method("PUT")
                                                                                    <button type="submit" class="btn btn-secondary">Rejected</button>
                                                                                </form>

                                                                                @endif

                                                                                <form class="col-md-4" action="{{route('billings.destroy',$billing)}}" method="post">
                                                                                    <input type="hidden" name="status" value="rejected">
                                                                                    @csrf
                                                                                    @method("DELETE")
                                                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
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
                                                <th>Created BY</th>
                                                <th>Confirmed By</th>
                                                <th>status</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
    </div>
@endsection
