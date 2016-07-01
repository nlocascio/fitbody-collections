<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Collections - @yield('dashhead-title')</title>

    <!-- CSS -->
    <link rel="stylesheet" href="/css/app.css">

    <!-- Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic" rel="stylesheet">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.1/css/font-awesome.min.css' rel='stylesheet' type='text/css'>


</head>
<body id="app" v-cloak>

<div class="container content">
    <div class="row">

        <!-- Sidebar -->
        <div class="col-sm-3 sidebar">
            @include('partials.sidebar')
        </div>

        <!-- Main -->
        <div class="col-sm-9 content">

            <!-- Dashhead -->
            @include('partials.dashhead')

            <!-- Errors -->
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Page Content -->
            @yield('content')

        </div>
    </div>
</div>


<!-- scripts -->
{{--<script src="/js/jquery.min.js"></script>--}}
{{--<script src="/js/jquery.hotkeys.js"></script>--}}
{{--<script src="/js/jquery.tablesorter.min.js"></script>--}}
{{--<script src="/js/angular.min.js"></script>--}}
{{--<script src="/js/bootstrap.min.js"></script>--}}
{{--<script src="/js/bootstrap-wysiwyg.min.js"></script>--}}
{{--<script src="/js/bootstrap-multiselect.js"></script>--}}
{{--<script src="/js/Chart.min.js"></script>--}}
{{--<script src="/js/chartjs-data-api.js"></script>--}}
{{--<script src="/js/pusher.min.js"></script>--}}
<script src="/js/app.js"></script>

@yield('footerScripts')

@if (session('download_on_next_page'))
    <script type="text/javascript">
        window.location.href = '{{ session('download_on_next_page') }}';
    </script>
@endif

@if (session('askForConfirmation'))
@include('partials.ask_for_confirmation')
@endif

</body>
</html>