@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Types List</h3>
                <div class="pull-right box-tools">
                    <a href="{{ route('types.create') }}" class="btn btn-info btn-sm">
                        <i class="fa fa-plus"></i> New Type
                    </a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="types_table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($types as $type)
                        <tr>
                            <td>{{ $type->id }}</td>
                            <td>{{ $type->name }}</td>
                            <td>
                                <a href="{{ route('types.edit',$type->id) }}" class="btn btn-xs btn-info">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="javascript:void(0);" class="btn btn-xs btn-danger delete_type">
                                    <i class="fa fa-trash"></i>
                                </a>
                                <form method="post" action="{{ route('types.destroy', $type->id) }}" style="display: none;">
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
                        <th>Name</th>
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
            $('#types_table').DataTable();
            $('.delete_type').click(function(){
                if(window.confirm('All the items using this type will be deleted to. Are you sure to delete this type?')){
                    $(this).parent().find('form').submit();
                }
            });
        });
    </script>
@endsection