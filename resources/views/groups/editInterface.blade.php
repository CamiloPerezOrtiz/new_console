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
                            <h3 class="box-title">Edit Interface</h3>
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
                        <form method="post" action="{{ route('editInterfacePost',$interface->id) }}">
                            {{csrf_field()}}
                            <input type="hidden" value="{{ $interface->campus_id }}" name="campus_id">
                            <div class="modal-body">
                                <div class="form-group">
                                        <label>Interface</label>
                                        <select name="interface" class="form-control input-sm">
                                            <option value="wan" @if($interface->interface == "wan") selected @endif>WAN</option>
                                            <option value="lan" @if($interface->interface == "lan") selected @endif >LAN</option>
                                            <option value="opt1" @if($interface->interface == "opt1") selected @endif >OPT1</option>
                                            <option value="opt2" @if($interface->interface == "opt2") selected @endif >OPT2</option>
                                            <option value="opt3" @if($interface->interface == "opt3") selected @endif >OPT3</option>
                                            <option value="opt4" @if($interface->interface == "opt4") selected @endif >OPT4</option>
                                            <option value="opt5" @if($interface->interface == "opt5") selected @endif >OPT5</option>
                                        </select>
                                        <small class="help-block">
                                            Select the interface. 
                                        </small>
                                    </div>
                                    <div class="form-group">
                                        <label>Name interface</label>
                                        <input type="text" class="form-control" name="name_interface" placeholder="Writte the name interface" value="{{ $interface->name }}">
                                        <small class="help-block">
                                            Writte the name of the interface.
                                        </small>
                                    </div>
                                    <div class="form-group">
                                        <label>Type interface</label>
                                        <input type="text" class="form-control" name="type_interface" placeholder="Writte the type interface" value="{{ $interface->type }}">
                                        <small class="help-block">
                                            Writte the name of the interface example: em0.
                                        </small>
                                    </div>
                                    <div class="form-group">
                                        <label>IP interface</label>
                                        <input type="text" class="form-control" name="ip_interface" placeholder="Writte the ip interface" value="{{ $interface->ip }}">
                                        <small class="help-block">
                                            Writte the name of the IP interface.
                                        </small>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <a href="{{ route('showInterfaces',$interface->campus_id) }}" class="btn btn-danger">Cancel</a>
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