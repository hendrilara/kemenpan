<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.png">

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

<body class="body-500">

<div class="container">

    <section class="error-wrapper">
        <i class="icon-500"></i>
        <h1>Registrasi Berhasil!</h1>
<!--        <h2>500 Page Error</h2>-->
        <p class="page-500">Untuk masuk ke dalam sistem, <a href="{{ url('login') }}">silahkan klik disini untuk login</a></p>
    </section>

</div>


</body>
</html>
