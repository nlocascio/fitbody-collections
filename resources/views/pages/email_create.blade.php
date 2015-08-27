@extends('layout')

@section('content')

    {!! Form::open(['method' => 'post', 'class' => 'form-horizontal',' id' => 'emailCreateForm']) !!}

    <div class="form-group">
        <label for="customer_id" class="col-sm-2 control-label">Customer</label>

        <div class="col-sm-10">
            {!! Form::select('customerIdSelect', $customers, $selectedCustomerIds, ['class' => 'form-control multiSelect', 'multiple', 'id' => 'customerIdSelect']) !!}
        </div>
    </div>

    <div class="form-group">
        <label for="form_letter_id" class="col-sm-2 control-label">Letter</label>

        <div class="col-sm-10">
            {!! Form::select('form_letter_id', $form_letters, null, ['placeholder' => 'Pick a letter...', 'class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            {!! Form::submit('Send', ['class' => 'btn btn-default', 'name' => 'send']) !!}
        </div>
    </div>

    {!! Form::close() !!}

@endsection

@section('footerScripts')
    <script type="text/javascript">
        $('.multiSelect').multiselect({
            maxHeight: 400,
            enableHTML: true,
            includeSelectAllOption: true,
            numberDisplayed: 1,
            nonSelectedText: 'Pick customer(s)...',
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true
        });

        $('#emailCreateForm').submit(function() {
            var customerIds = $('#customerIdSelect').val()

            $('#emailCreateForm').attr('action', '/customer/' + customerIds.join('+') + '/email');
        })
    </script>
@endsection