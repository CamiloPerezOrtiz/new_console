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
                            <h3 class="box-title">New Interface</h3>
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
                        <form method="post" action="{{ route('createInterfacePost') }}">
                            {{csrf_field()}}
                            <input type="hidden" value="{{ $id }}" name="campus_id">
                            <div class="modal-body">
                                <div class="form-group">
                                        <label>Interface</label>
                                        <select name="interface" class="form-control input-sm">
                                            <option value="wan">WAN</option>
                                            <option value="lan">LAN</option>
                                            <option value="opt1">OPT1</option>
                                            <option value="opt2">OPT2</option>
                                            <option value="opt3">OPT3</option>
                                            <option value="opt4">OPT4</option>
                                            <option value="opt5">OPT5</option>
                                        </select>
                                        <small class="help-block">
                                            Select the interface. 
                                        </small>
                                    </div>
                                    <div class="form-group">
                                        <label>Name interface</label>
                                        <input type="text" class="form-control" name="name_interface" placeholder="Writte the name interface" value="{{ old('name_interface') }}">
                                        <small class="help-block">
                                            Writte the name of the interface.
                                        </small>
                                    </div>
                                    <div class="form-group">
                                        <label>Type interface</label>
                                        <input type="text" class="form-control" name="type_interface" placeholder="Writte the type interface" value="{{ old('type_interface') }}">
                                        <small class="help-block">
                                            Writte the name of the interface example: em0.
                                        </small>
                                    </div>
                                    <div class="form-group">
                                        <label>IP interface</label>
                                        <input type="text" class="form-control" name="ip_interface" placeholder="Writte the ip interface" value="{{ old('ip_interface') }}">
                                        <small class="help-block">
                                            Writte the name of the IP interface.
                                        </small>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <a href="{{ route('showInterfaces',$id) }}" class="btn btn-danger">Cancel</a>
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