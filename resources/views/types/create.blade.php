@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class = "row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Create Type</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method = "POST" action = "{{ route('types.store') }}">
                        <div class="box-body">
                            @include('partials.error-message')
                            <div class="form-group col-md-12">
                                <label for="name">Type Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter type name" value = "{{ old('name') }}">
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a class="btn btn-default" href="{{ route('types.index') }}">Cancel</a>
                        </div>
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection