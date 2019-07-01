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
                            <h3 class="box-title">New Device</h3>
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
                        <form method="post" action="{{ route('createDevicePost') }}">
                            {{csrf_field()}}
                            <input type="hidden" value="{{ Crypt::decrypt($id) }}" name="group_id">
                            <div class="modal-body">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Campus</label>
                                        <input type="text" name="name" class="form-control" placeholder="Writte the campus name" value="{{ old('name') }}">
                                        <small class="help-block">
                                            Add the name of where the equipment is located.
                                        </small>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <a href="{{ route('showDevices',$id) }}" class="btn btn-danger">Cancel</a>
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