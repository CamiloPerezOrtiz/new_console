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
                            <h3 class="box-title">New Target Categories</h3>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            @if(Session::has('success'))
                                <div class="alert alert-info" aria-label="Close">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>{{Session::get('success')}}</strong>
                                </div>
                            @endif
                            @if(Session::has('danger'))
                                <div class="alert alert-danger" aria-label="Close">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>{{Session::get('danger')}}</strong>
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
                        <form method="post" action="{{ route('createTargetDevicePost', $id) }}">
                            {{csrf_field()}}
                            <input type="hidden" value="{{ $id }}" name="campus_id">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Choose the device to be apply change</label>
                                    <table class="table table-striped table-bordered table-hover">
                                        <tbody>
                                            @foreach($device as $devices)
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" class="form-check-input" name="campus[]" value="{{ $devices->name }}" 
                                                        @if (is_array($campus = old('campus')))
                                                            @foreach ($campus as $campuses)
                                                                @if($campuses == $devices->name) checked @endif
                                                             @endforeach
                                                         @endif> 
                                                        {{ $devices->name }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Writte the name" required value="{{ old('name') }}">
                                    <small class="help-block">
                                        Enter a unique name of this rule here. The name must consist between 2 and 15 symbols [a-Z_0-9].
                                    </small>
                                </div>
                                <div class="form-group">
                                    <label>Domain List</label>
                                    <textarea class="form-control" name="domain_list" rows="3" placeholder="Writte the domain list" required>{{ old('domain_list') }}</textarea>
                                    <small class="help-block">
                                        Enter destination domains or IP-addresses here. To separate them use space.<br>
                                        Example: mail.ru e-mail.ru yahoo.com 192.168.1.1
                                    </small>
                                </div>
                                <div class="form-group">
                                    <label>URL List</label>
                                    <textarea class="form-control" name="url_list" rows="3" placeholder="Writte the url list" required>{{ old('url_list') }}</textarea>
                                    <small class="help-block">
                                        Enter destination URLs here. To separate them use space.<br>
                                        Example: host.com/xxx 12.10.220.125/alisa
                                    </small>
                                </div>
                                <div class="form-group">
                                    <label>Regular Expression</label>
                                    <textarea class="form-control" name="expression_regular" rows="4" placeholder="Writte the regular expression" required>{{ old('expression_regular') }}</textarea>
                                    <small class="help-block">
                                        Enter word fragments of the destination URL. To separate them use | . <br>
                                        Example: mail|casino|game|\.rsdf$
                                    </small>
                                </div>
                                <div class="form-group">
                                    <label>Redirect mode</label>
                                    <select class="form-control" name="mode_redirect">
                                        <option value="rmod_none" @if(old('mode_redirect') == "rmod_none") selected @endif>none</option>
                                        <option value="rmod_int" @if(old('mode_redirect') == "rmod_int") selected @endif>int error page (enter error message)</option>
                                        <option value="rmod_int_bpg" @if(old('mode_redirect') == "rmod_int_bpg") selected @endif>int blank page </option>
                                        <option value="rmod_int_bim" @if(old('mode_redirect') == "rmod_int_bim") selected @endif>int blank image</option>
                                        <option value="rmod_ext_err" @if(old('mode_redirect') == "rmod_ext_err") selected @endif>ext url err page (enter URL)</option>
                                        <option value="rmod_ext_rdr" @if(old('mode_redirect') == "rmod_ext_rdr") selected @endif>ext url redirect (enter URL)</option>
                                        <option value="rmod_ext_mov" @if(old('mode_redirect') == "rmod_ext_mov") selected @endif>ext url move  (enter URL)</option>
                                        <option value="rmod_ext_fnd" @if(old('mode_redirect') == "rmod_ext_fnd") selected @endif>ext url found (enter URL)</option>
                                    </select>
                                    <small class="help-block">
                                        If you use 'transparent proxy', then 'int' redirect mode will not accessible.<br>
                                        Options:ext url err page , ext url redirect , ext url as 'move' , ext url as 'found'.
                                    </small>
                                </div>
                                <div class="form-group">
                                    <label>Redirect</label>
                                     <textarea class="form-control" name="redirect" rows="2" placeholder="Writte the url list" >{{ old('redirect') }}</textarea>
                                    <small class="help-block">
                                        Enter the external redirection URL, error message or size (bytes) here.
                                    </small>
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" class="form-control" name="description" placeholder="Writte the name" value="{{ old('description') }}">
                                    <small class="help-block">
                                        You may enter any description here for your reference.
                                    </small>
                                </div>
                                <div class="form-group">
                                    <label>Log</label>
                                    <label>
                                        <input type="hidden" name="log" value="off">
                                        <input type="checkbox" name="log" value="on" @if(old('log') == "on") checked @endif> Check this option to enable logging for this ACL.
                                    </label>
                                </div>
                                <div class="box-footer">
                                    <a href="{{ route('showGroupsTarget') }}" class="btn btn-danger">Cancel</a>
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