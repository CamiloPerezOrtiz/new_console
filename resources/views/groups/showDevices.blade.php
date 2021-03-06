@extends('layouts.console')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Devices
            </h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    @if(Session::has('success'))
                        <div class="alert alert-info" aria-label="Close">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>{{Session::get('success')}}</strong>
                        </div>
                    @endif
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="box-header">
                        @if(Auth::user()->role == 'SUPER')
                            <a href="{{ route('showGroups') }}" class="btn btn-danger">Back</a>
                        @endif
                        @if(Auth::user()->role == 'ADMIN')
                            <a href="{{ route('home') }}" class="btn btn-danger">Back</a>
                        @endif
                        <a href="{{ route('createDevice', $id) }}" class="btn btn-success">New Device</a>
                    </div>
                </div>
                @foreach($device as $devices)
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-blue">
                            <div class="inner">
                                <h3>{{ $devices->name }}</h3>
                            </div>
                            <div class="icon">
                                <i class="fa fa-list"></i>
                            </div>
                            <a href="{{ route('showInterfaces',$devices->id) }}" class="small-box-footer">View Interfaces <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection