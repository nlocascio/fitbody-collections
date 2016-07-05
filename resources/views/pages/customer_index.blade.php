@extends('layout')

@section('dashhead-subtitle','Dashboard')
@section('dashhead-title','Customers')

@section('dashhead-toolbar')
    <div class="btn-toolbar-item input-with-icon">
        <div class="btn-group pull-right">
            {!! Form::button('<i class="fa fa-refresh"></i>', ['class' => 'btn btn-default-outline', 'id' => 'customerRefreshButton', 'type' => 'submit']) !!}
        </div>
    </div>
@endsection

@section('content')
<div class="hr-divider">
    <h3 class="hr-divider-content hr-divider-heading">Quick stats</h3>
</div>
<div class="row statcards text-xs-center">
    <div class="col-xs-12 col-sm-6 statcard">
        <h3 class="statcard-number text-success">
            {{ $customers->count() }}
            <small class="delta-indicator delta-positive"></small>
        </h3>
        <span class="statcard-desc">Delinquent Accounts</span>
    </div>
    <div class="col-xs-12 col-sm-6 statcard">
        <h3 class="statcard-number text-danger">
            ${{ abs($customers->sum('account_balance')) }}
            <small class="delta-indicator delta-negative"></small>
        </h3>
        <span class="statcard-desc">Owed</span>
    </div>
</div>

<div class="flextable table-actions">
    <div class="flextable-item flextable-primary">
        <div class="btn-toolbar-item input-with-icon">
            <input type="text" class="form-control input-block" placeholder="Search customers">
            <span class="icon icon-magnifying-glass"></span>
        </div>
    </div>
    <div class="flextable-item">
        <div class="form-group">
            <div class="btn-group">
                <button type="button" class="btn btn-primary-outline dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                    <span class="icon icon-export"></span> <span class="caret"></span>
                </button>
                <ul class="dropdown-menu pull-right" role="menu">
                    <li><a href="#" id="createLetterLink"><span class="icon icon-newsletter"></span> Create
                            Letter</a>
                    </li>
                    <li><a href="#" id="createEmailLink"><span class="icon icon-mail"></span> Create Email</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="table-full">
    <div class="table-responsive">
        <table class="table" data-sort="table" id="customerTable">
            <thead>
            <tr>
                <th class="col-sm-1 text-center"><input type="checkbox" id="CheckAll"></th>
                <th class="col-sm-3">Name</th>
                <th class="col-sm-2">Phone</th>
                <th class="col-sm-1 text-right">Balance</th>
                <th class="col-sm-1">Emails</th>
                <th class="col-sm-1">Letters</th>
                <th class="col-sm-3"></th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr class="working hide">
                <th colspan="6" class="text-center btn-default-outline"><i class="fa fa-refresh fa-spin" style="font-size:10em;"></i></th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection

@section('footerScripts')
<!-- Pusher -->
<script>
    console.log('here');
</script>
<script src="https://js.pusher.com/3.1/pusher.min.js"></script>
<script>
    @if(App::isLocal())
    // Enable pusher logging - don't include this in production
    Pusher.log = function (message) {
        if (window.console && window.console.log) {
            window.console.log(message);
        }
    };
    @endif

    Window.pusher = new Pusher( '{{ config('broadcasting.connections.pusher.key') }}', {
        encrypted: true
    });
</script>

<!-- App -->
<script>
    $('#createLetterLink').on('click', function () {
        var values = [];

        $('input:checkbox[name=listCheckbox]:checked').each(function () {
            values.push($(this).val());
        })

        var href = '/customer/' + values.join('+') + '/letter/create';
        window.location.href = href;
    });

    $('#createEmailLink').on('click', function () {
        var values = [];

        $('input:checkbox[name=listCheckbox]:checked').each(function () {
            values.push($(this).val());
        })

        var href = '/customer/' + values.join('+') + '/email/create';
        window.location.href = href;
    });

    $('#customerRefreshButton').click(function () {
        $('#customerRefreshButton').prop('disabled', true).addClass('disabled');
        $('#customerRefreshButton i').addClass('fa-spin')
        $('#customerTable tr.working').removeClass('hide');

        $('#customerTable tbody').empty().trigger('update');

        $.post( '{{ route('customer.refresh') }}', { _token: '{{ csrf_token() }}' } );
    });

</script>
@endsection