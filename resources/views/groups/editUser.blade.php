@extends('layouts.console')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-8">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit User</h3>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            @if(Session::has('success'))
                                <div class="alert alert-info" aria-label="Close">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>{{Session::get('success')}}</strong>
                                </div>
                            @endif
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <form method="post" action="{{ route('editUserPost', $id) }}">
                            {{csrf_field()}}
                            <input type="hidden" value="{{ $user->group_id }}" name="group_id">
                            <div class="modal-body">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Writte the name" value="{{ $user->name }}">
                                        <small class="help-block">
                                            Writte the name of the user.
                                        </small>
                                    </div>
                                    <div class="form-group">
                                        <label>Lastname</label>
                                        <input type="text" class="form-control" name="lastname" placeholder="Writte the lastname" value="{{ $user->lastname }}">
                                        <small class="help-block">
                                            Writte the lastname of the user.
                                        </small>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control" name="email" placeholder="Writte the email" value="{{ $user->email }}">
                                        <small class="help-block">
                                            Writte the email of the user.
                                        </small>
                                    </div>
                                    <div class="form-group">
                                        <label>Role</label>
                                        <select class="form-control" name="role">
                                            <option value="USER" @if($user->role == "USER") selected @endif>User</option>
                                            <option value="ADMIN" @if($user->role == "ADMIN") selected @endif>Administrator</option>
                                        </select>
                                        <small class="help-block">
                                            Select the role of the user.
                                        </small>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <a href="{{ route('showUsers',$user->group_id) }}" class="btn btn-danger">Cancel</a>
                                    <button type="submit" name="guardar" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection