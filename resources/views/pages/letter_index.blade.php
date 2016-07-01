@extends('layout')

@section('dashhead-subtitle','Dashboard')
@section('dashhead-title','Letters')

@section('dashhead-toolbar')
    <input type="text" class="form-control input-block" placeholder="Search letters">
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
                    <a href="/customer/{{$customerId}}/letter/create" type="button" class="btn btn-primary-outline">
                        <span class="icon icon-new-message"></span>
                    </a>
                    <a href="#" type="button" class="btn btn-primary-outline" id="printLetterButton">
                        <span class="icon icon-print"></span>
                    </a>
                </div>
                <div class="btn-group">
                    {!! Form::open(['method' => 'delete', 'class' => 'form-inline form-horizontal', 'id' => 'deleteLettersForm']) !!}
                    {!! Form::button('<span class="icon icon-trash"></span>', ['class' => 'btn btn-primary-outline', 'type' => 'submit']) !!}
                    {{--{!! Form::hidden('letterId') !!}--}}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@include('partials.letters_table')
@endsection

@section('footerScripts')
    <script>
        $('#printLetterButton').on('click', function () {
            var letterIds = [];

            $('input:checkbox[name=letterCheckbox]:checked').each(function () {
                letterIds.push($(this).val());
            })

            var href = '{{ route('customer.letter.show', '*') }}/' + letterIds.join('+');
            window.location.href = href;
        });

        $('#deleteLettersForm').submit(function () {
            var letterIds = [];

            $('input:checkbox[name=letterCheckbox]:checked').each(function () {
                letterIds.push($(this).val());
            });

            $('#deleteLettersForm').attr('action', '{{ route('customer.letter.destroy','*') }}/' + letterIds.join('+'));

        });


        {{--var href = '{{ route('customer.letter.destroy', '*') }}/' + letterIds.join('+') + '?_method=DELETE';--}}
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