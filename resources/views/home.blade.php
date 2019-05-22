@extends('layouts.console')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Dashboard
            </h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-lg-3 col-xs-6 responsive">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>
                                @if(Auth::user()->role == 'SUPER')
                                    All groups
                                @endif
                                @if(Auth::user()->role == 'ADMIN' or Auth::user()->role == 'USER')
                                    Your group
                                @endif
                            </h3>
                            <p>
                                Info  
                            </p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-folder-o"></i>
                        </div>
                        <a href="{{-- path('leer_archivo_txt') --}}" class="small-box-footer">View Details <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>
                                All users
                            </h3>
                            <p>
                                Info
                            </p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-group"></i>
                        </div>
                        <a href="{{-- path('lista_usuarios') --}}" class="small-box-footer">View Details <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>T. categories</h3>
                            <p>Info</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-certificate"></i>
                        </div>
                        <a href="{{-- path('grupos_target') --}}" class="small-box-footer">View Details <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>ACL groups</h3>
                            <p>Info</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-shield"></i>
                        </div>
                        <a href="{{-- path('grupos_acl') --}}" class="small-box-footer">View Details <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>Aliases</h3>
                            <p>Info</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-th-large"></i>
                        </div>
                        <a href="{{-- path('grupos_aliases') --}}" class="small-box-footer">View Details <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                {{--<div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>Nats</h3>
                            <p>Info</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-book"></i>
                        </div>
                        <a href="{{ path('gruposNat') }}" class="small-box-footer">View Details <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>--}}
                <div class="col-lg-3 col-xs-6 responsive">
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>Firewall rules</h3>
                            <p>Info</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-fire"></i>
                        </div>
                        <a href="{{-- path('gruposFirewall') --}}" class="small-box-footer">View Details <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
