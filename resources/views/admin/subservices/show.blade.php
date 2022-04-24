@extends('layouts.adminapp')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sub-service</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Sub-service</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card card-solid">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div class="col-12">
                            <img src="/storage/subservices/{{$subservice->image}}" class="product-image"
                                alt="Sub-service Image">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <h3 class="my-3">{{$subservice->name}}</h3>
                        <p>{{$subservice->description}}
                        </p>

                        <hr>

                        <div class="bg-gray py-2 px-3 mt-4">
                            <h2 class="mb-0">
                                Price : Ksh {{$subservice->price}} /=
                            </h2>
                        </div>
                        @if (  Auth::user()->isManager() )
                        <div class="mt-4 product-share">
                            <div class="row">
                                <div>
                                    <a class="btn btn-sm btn-success"
                                        href="{{route('subservices.edit',$subservice->id)}}" class="text-gray">
                                        Edit
                                    </a>
                                </div>
                                <div>
                                    <form method="post" action="{{route('subservices.destroy',$subservice->id)}}">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            onclick="return confirm('Are you sure you want to delete this record?;')"
                                            class="btn btn-sm btn-danger" type="submit">Delete</button>

                                    </form>
                                </div>
                            </div>



                        </div>

                        @endif



                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
