@extends('layouts.console')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Target Categories
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
                        <a href="{{ route('home') }}" class="btn btn-danger">Back</a>
                    </div>
                </div>
                @foreach($group as $groups)
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-blue">
                            <div class="inner">
                                <h3>{{ $groups->name }}</h3>
                            </div>
                            <div class="icon">
                                <i class="fa fa-list"></i>
                            </div>
                            <a href="{{ route('showDevicesTarget',$groups->id) }}" class="small-box-footer">View Devices <i class="fa fa-arrow-circle-right"></i></a>
                            <a href="{{ route('createTargetDevice',$groups->id) }}" class="small-box-footer">New Target Categories <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection