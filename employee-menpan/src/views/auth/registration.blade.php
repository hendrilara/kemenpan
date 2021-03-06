<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.html">

    <title>@yield('title', 'MSDM-TBK')</title>

    <!-- Bootstrap core CSS -->
    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/bootstrap-reset.css') }}
    <!--external css-->
    {{ HTML::style('assets/font-awesome/css/font-awesome.css')}}
    <!-- Custom styles for this template -->
    {{ HTML::style('css/style.css')}}
    {{ HTML::style('css/style-responsive.css')}}

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    {{ HTML::script('js/html5shiv.js')}}
    {{ HTML::script('js/respond.min.js')}}
    <![endif]-->
</head>

<body class="login-body">
<div class="container">
    @if(Session::has('message'))
    <div class="alert alert-warning fade in">
        <button data-dismiss="alert" class="close close-sm" type="button">
            <i class="fa fa-times"></i>
        </button>
        {{ Session::get('message') }}
    </div>
    @endif


    {{ Form::open(array('url'=>Request::url(), 'class'=>'form-signin', 'method' => 'post')) }}
    <h2 class="form-signin-heading">@yield('signin','Registrasi Karyawan')</h2>
    <div class="login-wrap">
        @if ($errors->has())
        <div class="alert alert-danger fade in">
            @foreach ($errors->all() as $error)
            {{ $error }} <br/>
            @endforeach
        </div>
        @endif


        {{ Form::text('nip', '', array('class'=>'form-control', 'placeholder'=>'NIP')) }}
        {{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'kata sandi')) }}
        {{ Form::password('password_conf', array('class'=>'form-control', 'placeholder'=>'konfirmasi kata sandi')) }}
        <div class="registration">
            Sudah teregistrasi?
            <a class="" href="{{ url('login') }}">
                Silakan login disini
            </a>
        </div>
        <button class="btn btn-lg btn-login btn-block" type="submit">Registrasi Akun</button>
        <div style="text-align: center;">
            <img src="{{ asset('img/logo_pan.png') }}" height="100px" style="text-align: center;" />
        </div>
    </div>
    {{ Form::close() }}
</div>
</body>
</html>
