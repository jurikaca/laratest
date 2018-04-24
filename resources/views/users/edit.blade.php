@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class = "row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit User</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method = "POST" action = "{{ route('users.update', $user->id) }}">
                        {{ method_field('patch') }}
                        <div class="box-body">
                            @include('partials.error-message')
                            <div class="form-group col-md-6">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" value = "{{ $user->username }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" value = "{{ $user->email }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="role">Role</label>
                                <select class="form-control" name="role" id="role">
                                    <option value = "">Select role...</option>
                                    @foreach($roles as $key => $role)
                                        <option value = "{{ $key }}" {{ $user->role == $key ? 'selected' : ''}}>{{ $role }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a class="btn btn-default" href="{{ route('users.index') }}">Cancel</a>
                        </div>
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection