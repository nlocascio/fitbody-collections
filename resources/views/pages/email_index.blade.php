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
                    <a href="/customer/email/create" type="button" class="btn btn-primary-outline">
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

@include('partials.emails_table')
@endsection

@section('footerScripts')
    <script>
        $('#printLmailButton').on('click', function () {
            var emailIds = [];

            $('input:checkbox[name=emailCheckbox]:checked').each(function () {
                emailIds.push($(this).val());
            })

            var href = '/' + emailIds.join('+');
            window.location.href = href;
        });

        $('#deleteLmailsForm').submit(function () {
            var emailIds = [];

            $('input:checkbox[name=emailCheckbox]:checked').each(function () {
                emailIds.push($(this).val());
            });

            $('#deleteLmailsForm').attr('action', '/' + emailIds.join('+'));

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