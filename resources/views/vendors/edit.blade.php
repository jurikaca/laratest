@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class = "row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Vendor</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method = "POST" action = "{{ route('vendors.update', $vendor->id) }}" enctype="multipart/form-data">
                        {{ method_field('patch') }}
                        <div class="box-body">
                            @include('partials.error-message')
                            <div class="form-group col-md-12">
                                <label for="name">Vendor Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Vendor name" value = "{{ $vendor->name }}">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="file">Logo</label>
                                @if($vendor->logo)
                                    <div class="margin-bottom">
                                        <img src = "/vendors_img/{{ $vendor->logo }}" height="100px"/>
                                    </div>
                                @endif
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