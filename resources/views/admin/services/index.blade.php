@extends('layouts.adminapp')
@section('content')

<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="content-header">
                <div class="container-fluid">
                  <div class="row mb-2">
                    <div class="col-sm-6">
                      <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Services </li>
                      </ol>
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div><!-- /.container-fluid -->
              </div>

            <!-- Main row -->
            <div class="row">
                {{-- data --}}
                <!-- /.card -->

                <div class="card col-md-12 ">
                    <div class="card-header">
                        <h3 class="card-title">Services Offered</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($services as $service)
                                <tr>
                                    <td>{{$service->name}}</td>
                                    <td>{{Str::limit($service->description,100)}}</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-4 ">
                                                <a href="{{route('services.show',$service->id)}}" class="btn btn-sm btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            </div>
                                            @if ( ! Auth::user()->isClient() )
                                            <div class="col-md-4 ">
                                                <a href="{{route('services.edit',$service->id)}}" class="btn btn-sm btn-warning"> Edit </a>
                                            </div>
                                            @endif
                                            @if (  Auth::user()->isManager() )
                                            <div class="col-md-4 " >
                                                <form action="{{ route('services.destroy',$service->id) }}" onsubmit="return confirm('Are you sure you need to delete Service')" method="post">
                                                    @method("DELETE")
                                                    @csrf
                                                    <button class="btn btn-danger" type="submit"> <i class="fa fa-trash" aria-hidden="true"></i> </button>
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
                                    <th>Name</th>
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
