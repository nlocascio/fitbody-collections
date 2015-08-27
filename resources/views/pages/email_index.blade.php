@extends('layout')

@section('dashhead-subtitle','Dashboard')
@section('dashhead-title','Emails')

@section('dashhead-toolbar')
    <input type="text" class="form-control input-block" placeholder="Search emails">
    <span class="icon icon-magnifying-glass"></span>
@endsection

@section('content')
    <div class="flextable table-actions">
        <div class="flextable-item flextable-primary">
            <div class="btn-toolbar-item input-with-icon">
                <input type="text" value="01/01/15 - 01/08/15" class="form-control" data-provide="datepicker">
                <span class="icon icon-calendar"></span>
            </div>
        </div>
        <div class="flextable-item">
            <div class="form-group">
                <div class="btn-group">
                    <a href="/customer/{{$customerId}}/email/create" type="button" class="btn btn-primary-outline">
                        <span class="icon icon-new-message"></span>
                    </a>
                    <a href="#" type="button" class="btn btn-primary-outline" id="printLmailButton">
                        <span class="icon icon-print"></span>
                    </a>
                </div>
                <div class="btn-group">
                    {!! Form::open(['method' => 'delete', 'class' => 'form-inline form-horizontal', 'id' => 'deleteLmailsForm']) !!}
                    {!! Form::button('<span class="icon icon-trash"></span>', ['class' => 'btn btn-primary-outline', 'type' => 'submit']) !!}
                    {{--{!! Form::hidden('emailId') !!}--}}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <div class="table-full">
        <div class="table-responsive">
            <table class="table" data-sort="table">
                <thead>
                <tr>
                    <th class="col-sm-1 text-center">
                        <div class="pull-left">
                            <input type="checkbox" id="CheckAll">
                        </div>
                    </th>
                    <th class="header headerSortDown col-sm-1">#</th>
                    <th class="header col-sm-3">Customer name</th>
                    <th class="header col-sm-3">Description</th>
                    <th class="header col-sm-2">Date</th>
                    <th class="header col-sm-1">Total</th>
                </tr>
                </thead>
                <tbody>

                @foreach($emails as $email)
                    <tr>
                        <td>
                            <div class="pull-left">
                                {!! Form::checkbox('emailCheckbox', $email->id, false, ['class' => 'multiSelectCheckBox']) !!}

                                <div class="row">
                                    <div class="col-xs-5">
                                        {{--<input type="checkbox" name="emailCheckbox" value="{{$email->id}}">--}}
                                    </div>
                                    <div class="col-xs-7">
                                        {{--{!! Form::open(['method' => 'delete', 'class' => 'form-inline', 'url' => route('customer.email.destroy', ['customer' => $email->customer, 'email' => $email])]) !!}--}}
                                        {{--{!! Form::button('<span class="icon icon-trash"></span>', ['class' => 'btn btn-primary-outline btn-xs', 'type' => 'submit']) !!}--}}
                                        {{--{!! Form::close() !!}--}}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td><a href="/customer/{{$email->customer->id}}/email/{{$email->id}}">#{{$email->id}}</a>
                        </td>
                        <td>{{$email->customer->last_name}}, {{$email->customer->first_name}}</td>
                        <td>{{$email->description}}</td>
                        <td>{{Carbon\Carbon::parse($email->created_at)->toFormattedDateString()}}</td>
                        <td>{{$email->amount}}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('footerScripts')
    <script>
        $('#printLmailButton').on('click', function () {
            var emailIds = [];

            $('input:checkbox[name=emailCheckbox]:checked').each(function () {
                emailIds.push($(this).val());
            })

            var href = '{{ route('customer.email.show', '*') }}/' + emailIds.join('+');
            window.location.href = href;
        });

        $('#deleteLmailsForm').submit(function () {
            var emailIds = [];

            $('input:checkbox[name=emailCheckbox]:checked').each(function () {
                emailIds.push($(this).val());
            });

            $('#deleteLmailsForm').attr('action', '{{ route('customer.email.destroy','*') }}/' + emailIds.join('+'));

        });


        {{--var href = '{{ route('customer.email.destroy', '*') }}/' + emailIds.join('+') + '?_method=DELETE';--}}
        //            window.location.href = href;
        //            console.log(href);

        {{--$.ajax({--}}
        {{--method: 'DELETE',--}}
        {{--url: href,--}}
        {{--data: { _token: '{{ csrf_token() }}' },--}}
        {{--success: function() { location.reload(); }--}}
        {{--})--}}

    </script>
@endsection