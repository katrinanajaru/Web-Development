@extends('layouts.adminapp')
@section('content')

{{--  --}}


{{--  --}}
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Billings </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Billing Form</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <!-- general form elements   -->
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Billing</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="flex flex-col justify-around h-full">
                                <form action="{{route('billings.store')}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input id="name" class="form-control" type="text" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">Amount</label>
                                        <input id="amount" class="form-control" type="text" name="amount">
                                    </div>
                                    <input type="hidden" name="created_by" value="{{auth()->user()->id}}">
                                    <textarea name="reason" class="form-control" id="" cols="50" rows="10" placeholder="Reason for this billing....." ></textarea>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
