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
                            <h3 class="box-title">New User</h3>
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
                        <form method="post" action="{{ route('createUserPost', $id) }}">
                            {{csrf_field()}}
                            <div class="modal-body">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Writte the name" value="{{ old('name') }}">
                                        <small class="help-block">
                                            Writte the name of the user.
                                        </small>
                                    </div>
                                    <div class="form-group">
                                        <label>Lastname</label>
                                        <input type="text" class="form-control" name="lastname" placeholder="Writte the lastname" value="{{ old('lastname') }}">
                                        <small class="help-block">
                                            Writte the lastname of the user.
                                        </small>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control" name="email" placeholder="Writte the email" value="{{ old('email') }}">
                                        <small class="help-block">
                                            Writte the email of the user.
                                        </small>
                                    </div>
                                    <div class="form-group">
                                        <label>Role</label>
                                        <select class="form-control" name="role">
                                            <option value="USER">User</option>
                                            <option value="ADMIN">Administrator</option>
                                        </select>
                                        <small class="help-block">
                                            Select the role of the user.
                                        </small>
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="Writte the password" value="{{ old('email') }}">
                                        <small class="help-block">
                                            The password must contain uppercase letters, lowercase, numbers and characters. Minimum 8 characters.
                                        </small>
                                    </div>
                                    <div class="form-group">
                                        <label>Repeat Password</label>
                                        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm the password" value="{{ old('email') }}">
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <a href="{{ route('showUsers',$id) }}" class="btn btn-danger">Cancel</a>
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