<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sinthesis - Dashboard</title>

    <link href="{{ asset("css/bootstrap.min.css") }}" rel="stylesheet">
    <link href="{{ asset("css/datepicker3.css") }}" rel="stylesheet">
    <link href="{{ asset("css/styles.css") }}" rel="stylesheet">

    <!--Icons-->
    <script src="{{ asset('js/lumino.glyphs.js')}}"></script>

    <!--[if lt IE 9]>
    <script src="{{ asset('js/html5shiv.js')}}"></script>
    <script src="{{ asset('js/respond.min.js')}}"></script>
    <![endif]-->

</head>

<body>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><span>Sinthesis</span></a>
            <ul class="user-menu">
                <li class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> {{Auth::user()->username}}<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/logout"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>

    </div><!-- /.container-fluid -->
</nav>

@include('nav.nav_left')

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

    @yield('content')

</div>	<!--/.main-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="{{ asset('js/bootstrap.min.js')}}"></script>
@yield('scripts')
</body>

</html>
