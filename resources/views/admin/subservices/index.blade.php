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
                        <li class="breadcrumb-item active">Sub-Services </li>
                      </ol>
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div><!-- /.container-fluid -->
              </div>

            <!-- Main row -->
            <div class="row">
                {{-- data --}}
                <!-- /.card -->

                <div class="card col-md-12">
                    <div class="card-header">
                        <h3 class="card-title">Services Offered</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body col-md-12">
                        <table id="example1" class="table table-bordered table-striped col-md-12">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Image</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($subservices as $subservice)
                                <tr>
                                    <td>{{$subservice->name}}</td>
                                    <td>{{$subservice->price}}</td>
                                    <td><img src="/storage/subservices/{{$subservice->image}}" class="img-circle elevation-2"
                                        alt="sub-service"></td>
                                    <td>{{Str::limit($subservice->description,80)}}</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <a href="{{route('subservices.show',$subservice->id)}}" class="btn btn-sm btn-info">view</a>
                                            </div>


                                            @if (  Auth::user()->isManager() )
                                            <div class="col-md-4">
                                                <a href="{{route('subservices.edit',$subservice->id)}}" class="btn btn-sm btn-warning">Edit</a>
                                            </div>
                                            <div class="col-md-4 " >
                                                <form action="{{ route('subservices.destroy',$subservice->id) }}" onsubmit="return confirm('Are you sure you need to delete Subservice')" method="post">
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
                                    <th>Price</th>
                                    <th>Image</th>
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
