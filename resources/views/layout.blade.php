<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Collections - @yield('dashhead-title')</title>

</head>
<body>

<div class="container">
    <div class="row">

        <!-- Sidebar -->
        <div class="col-sm-3 sidebar">
            @include('partials.sidebar')
        </div>

        <!-- Main -->
        <div class="col-sm-9 content">

            <div class="dashhead">
                <div class="dashhead-titles">
                    <h6 class="dashhead-subtitle">@yield('dashhead-subtitle')</h6>

                    <h2 class="dashhead-title">@yield('dashhead-title')</h2>
                </div>

                <div class="btn-toolbar dashhead-toolbar">
                    <div class="btn-toolbar-item input-with-icon">
                        @yield('dashhead-toolbar')
                    </div>
                </div>
            </div>

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</div>

@if (session('download_on_next_page'))
<script type="text/javascript">
    window.location.href = '{{ session('download_on_next_page') }}';
</script>
@endif

<!-- css -->
<link href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{ elixir('css/all.css') }}">


<script src="/js/jquery.min.js"></script>
<script src="/js/jquery.hotkeys.js"></script>
<script src="/js/jquery.tablesorter.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/bootstrap-wysiwyg.min.js"></script>
<script src="/js/bootstrap-multiselect.js"></script>
<script src="/js/Chart.min.js"></script>
<script src="/js/chartjs-data-api.js"></script>
<script src="{{ elixir('js/app.js') }}"></script>

@yield('footerScripts')

@if (session('askForConfirmation'))
    <div class="modal fade" id="askForConfirmationModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Confirmation</h4>
                </div>
                <div class="modal-body">
                    <p>{!! (session('askForConfirmation')['message'])  !!}</p>
                </div>
                <div class="modal-footer">

                    {!! Form::open([
                        'method' => session('askForConfirmation')['method'],
                        'class' => 'form-inline',
                        'url' => session('askForConfirmation')['url']
                        ])
                    !!}
                    @if(isset(session('askForConfirmation')['data']))
                        @foreach (session('askForConfirmation')['data'] as $k => $v)
                            {!! Form::hidden($k, $v) !!}
                        @endforeach
                    @endif
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    {!! Form::button(session('askForConfirmation')['submitName'], ['class' => 'btn btn-primary', 'type' => 'submit', 'name' => 'confirmed', 'value' => 'true']) !!}
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('#askForConfirmationModal').modal('show');
    </script>
@endif

</body>
</html>