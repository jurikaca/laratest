@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Vendors List</h3>
                @if(\Illuminate\Support\Facades\Auth::user()->role != \App\User::ADMIN)
                    <div class="pull-right box-tools">
                        <a href="{{ route('vendors.create') }}" class="btn btn-info btn-sm">
                            <i class="fa fa-plus"></i> New Vendor
                        </a>
                    </div>
                @endif
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="vendors_table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Logo</th>
                            <th>Vendor Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($vendors as $vendor)
                        <tr>
                            <td>{{ $vendor->id }}</td>
                            <td>
                                @if($vendor->logo)
                                    <img src = "/vendors_img/{{ $vendor->logo }}" height="50px"/>
                                @else
                                    No Logo
                                @endif
                            </td>
                            <td>{{ $vendor->name }}</td>
                            <td>
                                <a href="{{ route('vendors.edit',$vendor->id) }}" class="btn btn-xs btn-info">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="javascript:void(0);" class="btn btn-xs btn-danger delete_vendor">
                                    <i class="fa fa-trash"></i>
                                </a>
                                <form method="post" action="{{ route('vendors.destroy', $vendor->id) }}" style="display: none;">
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
                        <th>Logo</th>
                        <th>Vendor Name</th>
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
    <script>
        $(document).ready(function(){
            $('#vendors_table').DataTable();
            $('.delete_vendor').click(function(){
                if(window.confirm('Are you sure to delete this vendor?')){
                    $(this).parent().find('form').submit();
                }
            });
        });
    </script>
@endsection