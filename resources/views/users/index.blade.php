@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Users List</h3>
                <div class="pull-right box-tools">
                    <a href="{{ route('users.create') }}" class="btn btn-info btn-sm">
                        <i class="fa fa-plus"></i> New User
                    </a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="users_table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Is Active</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <div class="form-group">
                                    <select class="form-control role_select" data-user_id = "{{ $user->id }}">
                                        @foreach($roles as $key => $role)
                                            <option value = "{{ $key }}" {{ $user->role == $key ? 'selected' : ''}}>{{ $role }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                            <td>
                                <input class="active_checkbox" type="checkbox" {{ $user->isActive == 1 ? 'checked' : '' }} data-user_id = "{{ $user->id }}"/>
                            </td>
                            <td>
                                <a href="{{ route('users.edit',$user->id) }}" class="btn btn-xs btn-info">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="javascript:void(0);" class="btn btn-xs btn-danger delete_user">
                                    <i class="fa fa-trash"></i>
                                </a>
                                <form method="post" action="{{ route('users.destroy', $user->id) }}" style="display: none;">
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
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Is Active</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                </table>
                <form style="display: none;">
                    <input type="hidden" name="csrf_token" id="csrf_token" value = "{{ csrf_token() }}"/>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
@endsection

@section('script')
    <script src="/js/users.index.js"></script>
@endsection