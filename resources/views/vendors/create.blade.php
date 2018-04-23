@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class = "row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Create Vendor</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method = "POST" action = "{{ route('vendors.store') }}" enctype="multipart/form-data">
                        <div class="box-body">
                            @include('partials.error-message')
                            <div class="form-group col-md-12">
                                <label for="name">Vendor Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Vendor name" value = "{{ old('name') }}">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="file">File input</label>
                                <input type="file" id="file" name="file">
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a class="btn btn-default" href="{{ route('vendors.index') }}">Cancel</a>
                        </div>
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection