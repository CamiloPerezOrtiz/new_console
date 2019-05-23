<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title' ,'Warriors Labs')</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ asset ('vendor/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset ('vendor/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset ('vendor/Ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset ('vendor/dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset ('vendor/dist/css/skins/_all-skins.css') }}">
    <link rel="stylesheet" href="{{ asset ('vendor/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="icon" type="image/x-icon" href="{{ asset('log.ico') }}">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <header class="main-header">
        <a href="{{-- path('dashboard') --}}" class="logo">
            <span class="logo-mini"><b>W</b>L</span>
            <span class="logo-lg"><b>Warriors </b>Labs</span>
        </a>
        <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#">
                            <img src="{{ asset('img/usuario.png') }}" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{ Auth::user()->name }} {{ Auth::user()->lastname }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <aside class="main-sidebar">
        <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ asset('img/logo.png') }}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    @if(Auth::user()->role == 'SUPER')
                        SUPER USER
                    @endif
                    @if(Auth::user()->role == 'ADMIN')
                        Administrator
                    @endif
                    @if(Auth::user()->role == 'USER')
                        User
                    @endif
                </div>
            </div>
            <ul class="sidebar-menu" data-widget="tree">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                <li><a href="{{ route('showGroups') }}"><i class="fa fa-folder-o"></i> <span>Groups</span></a></li>
                <li><a href="{{-- path('lista_usuarios') --}}"><i class="fa fa-group"></i> <span>List users</span></a></li>
                <li><a href="{{-- path('grupos_target') --}}"><i class="fa fa-certificate"></i> <span>Target categories</span></a></li>
                <li><a href="{{-- path('grupos_acl') --}}"><i class="fa fa-shield"></i> <span>ACL groups</span></a></li>
                <li><a href="{{-- path('grupos_aliases') --}}"><i class="fa fa-th-large"></i> <span>Aliases</span></a></li>
                {{--<li><a href="{{ path('gruposNat') }}"><i class="fa fa-book"></i> <span>NAT</span></a></li>--}}
                <li><a href="{{-- path('gruposFirewall') --}}"><i class="fa fa-fire"></i> <span>Firewall rules</span></a></li>
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </section>
    </aside>
    @yield('content')
    <footer class="main-footer">
        <span>Warriors labs <sup>©</sup> All Rights Reserved.</span>
    </footer>
    <aside class="control-sidebar control-sidebar-dark">
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs"></ul>
        <div class="tab-content">
            <div class="tab-pane" id="control-sidebar-home-tab"></div>
        </div>
    </aside>
    </div>
    <div class="control-sidebar-bg"></div>
    <script src="{{ asset ('vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset ('vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset ('vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset ('vendor/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset ('vendor/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset ('vendor/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ asset ('vendor/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset ('vendor/dist/js/demo.js') }}"></script>
    <script>
        $(function () {
            $('#example1').DataTable()
        });
    </script>
</body>
</html>