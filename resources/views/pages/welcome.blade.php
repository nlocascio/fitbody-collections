<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title></title>

    <link rel="stylesheet" href="{{ elixir('css/all.css') }}">

</head>
<body id="welcome">

<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#home-nav"
                    aria-expanded="false">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="navbar-brand">
                <span class="icon icon-tree navbar-brand-icon"></span>
                {{ config('app.name') }}
            </div>
        </div>

        <div class="navbar-collapse collapse" id="home-nav" aria-expanded="false" style="height: 22px;">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/auth/login">Log In</a></li>
                <li><a href="/auth/register">Register</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="hero">
    <div class="container">
        <h1><strong>Easy, Automated</strong> Account Collections</h1>
        <p><span style="font-weight:bold;"></span>Built for MINDBODY businesses.</p>
        <a href="#" class="btn btn-default btn-lg">Start Now</a>
        <a href="#" class="btn btn-default btn-lg">Take The 60 Second Tour</a>
    </div>
</div>

<!-- css -->
<link href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic" rel="stylesheet">

<!-- scripts -->
<script src="/js/jquery.min.js"></script>
<script src="/js/jquery.hotkeys.js"></script>
<script src="/js/jquery.tablesorter.min.js"></script>
<script src="/js/angular.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/bootstrap-wysiwyg.min.js"></script>
<script src="/js/bootstrap-multiselect.js"></script>
<script src="/js/Chart.min.js"></script>
<script src="/js/chartjs-data-api.js"></script>
<script src="/js/pusher.min.js"></script>
<script src="{{ elixir('js/app.js') }}"></script>

</body>
</html>