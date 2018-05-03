@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Items List</h3>
                @if(\Illuminate\Support\Facades\Auth::user()->role != \App\User::ADMIN)
                    <div class="pull-right box-tools">
                        <a href="{{ route('items.create') }}" class="btn btn-info btn-sm">
                            <i class="fa fa-plus"></i> New Item
                        </a>
                    </div>
                @endif
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="items_table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Item</th>
                            <th>Vendor</th>
                            <th>Type</th>
                            <th>Serial Number</th>
                            <th>Price</th>
                            <th>Weight</th>
                            <th>Color</th>
                            <th>Release Date</th>
                            <th>Tags</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>@if($item->photo)
                                    <div class="margin-bottom">
                                        <img src = "/images/{{ $item->photo }}" height="50px"/>
                                    </div>
                                @endif
                                {{ $item->item_name }}
                            </td>
                            <td>{{ $item->vendor->name }}</td>
                            <td>{{ $item->type->name }}</td>
                            <td>{{ $item->serial_number }}</td>
                            <td>{{ $item->price }}</td>
                            <td>{{ $item->weight }}</td>
                            <td>{{ $item->color }}</td>
                            <td>{{ $item->release_date }}</td>
                            <td>{{ $item->tags }}</td>
                            <td>
                                <a href="{{ route('items.edit',$item->id) }}" class="btn btn-xs btn-info">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="javascript:void(0);" class="btn btn-xs btn-danger delete_item">
                                    <i class="fa fa-trash"></i>
                                </a>
                                <form method="post" action="{{ route('items.destroy', $item->id) }}" style="display: none;">
                                    {{ method_field('delete') }}
                                    {{ csrf_field() }}
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Item</th>
                        <th>Vendor</th>
                        <th>Type</th>
                        <th>Serial Number</th>
                        <th>Price</th>
                        <th>Weight</th>
                        <th>Color</th>
                        <th>Release Date</th>
                        <th>Tags</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
@endsection

@section('script')
    <script src="/js/items.index.js"></script>
@endsection