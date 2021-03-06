@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class = "row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Create Item</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method = "POST" action = "{{ route('items.store') }}" enctype="multipart/form-data">
                        <div class="box-body">
                            @include('partials.error-message')
                            <div class="form-group col-md-4">
                                <label for="item_name">Item Name</label>
                                <input type="text" class="form-control" name="item_name" id="item_name" placeholder="Enter item name" value = "{{ old('item_name') }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="vendor_id">Vendor</label>
                                <select class="form-control" name="vendor_id" id="vendor_id">
                                    <option value = "">Select vendor...</option>
                                    @foreach($vendors as $vendor)
                                        <option value = "{{ $vendor->id }}" {{ old('vendor_id') == $vendor->id ? 'selected' : ''}}>{{ $vendor->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="type_id">Type</label>
                                <select class="form-control" name="type_id" id="type_id">
                                    <option value = "">Select type...</option>
                                    @foreach($types as $type)
                                        <option value = "{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : ''}}>{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="item_name">Serial Number</label>
                                <input type="text" class="form-control" name="serial_number" id="serial_number" placeholder="Enter Serial Number " value = "{{ old('serial_number') }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="price">Item Price</label>
                                <input type="number" step=any class="form-control" name="price" id="price" placeholder="Enter price " value = "{{ old('price') }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="weight">Item Weight</label>
                                <input type="text" class="form-control" name="weight" id="weight" placeholder="Enter item weight " value = "{{ old('weight') }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="color">Item Color</label>
                                <input type="text" class="form-control" name="color" id="color" placeholder="Enter item color " value = "{{ old('color') }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="release_date">Release Date</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" name="release_date" id="release_date" value = "{{ old('release_date') }}">
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="tags">Tags</label>
                                <input type="text" data-role="tagsinput" class="form-control" name="tags" id="tags" value = "{{ old('tags') }}">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="file">File input</label>
                                <input type="file" id="file" name="file">
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a class="btn btn-default" href="{{ route('items.index') }}">Cancel</a>
                        </div>
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script src="/js/items.form.js"></script>
@endsection