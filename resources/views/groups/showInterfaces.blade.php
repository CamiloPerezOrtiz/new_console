@extends('layouts.console')
@section('content')    
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Device Information</h3>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="box-header">
                                    <a href="{{ route('createInterface', $id) }}" class="btn btn-success">New Interface</a>
                                </div>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="box-body table-responsive no-padding">
                                <table id="example1" class="table table-bordered table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th>Interface</th>   
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>IP</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($interface as $interfaces)
                                            <tr>
                                                <td>{{ $interfaces->interface }}</td>
                                                <td>{{ $interfaces->name }}</td>
                                                <td>{{ $interfaces->type }}</td>
                                                <td>{{ $interfaces->ip }}</td>
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