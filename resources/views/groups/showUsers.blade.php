@extends('layouts.console')
@section('content')    
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Users</h3>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="box-header">
                                    <a href="{{ route('showGroups') }}" class="btn btn-danger">Back</a>
                                    <a href="{{ route('createUser', $id) }}" class="btn btn-success">New User</a>
                                </div>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="box-body table-responsive no-padding">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    @if(Session::has('success'))
                                        <div class="alert alert-info" aria-label="Close">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            <strong>{{Session::get('success')}}</strong>
                                        </div>
                                    @endif
                                </div>
                                <table id="example1" class="table table-bordered table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th>Name</th>   
                                            <th>Lastname</th>
                                            <th>email</th>
                                            <th>Role</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($user as $users)
                                            <tr>
                                                <td>{{ $users->name }}</td>
                                                <td>{{ $users->lastname }}</td>
                                                <td>{{ $users->email }}</td>
                                                <td>{{ $users->role }}</td>
                                                <td>
                                                    <a href="{{ route('editUser', $users->id) }}" class="btn btn-warning btn-xs">
                                                        <i class="fa fa-pencil"></i> Edit 
                                                    </a> 
                                                </td>
                                                <td>
                                                    <a href="{{ route('deleteUser', $users->id) }}" class="btn btn-danger btn-xs">
                                                        <i class="fa fa-trash-o"></i> Delete 
                                                    </a> 
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection