@extends('layout')



@section('content')

    {!! Form::open(['method' => 'post', 'class' => 'form-horizontal',' id' => 'letter-create-form', 'url' => '/customer/*/letter']) !!}

    <div class="form-group">
        <label for="customer_id" class="col-sm-2 control-label">Customer</label>
        <div class="col-sm-10">
            {!! Form::select('customer_id[]', $customers, $selectedCustomerIds, ['class' => 'form-control multiSelect', 'multiple']) !!}
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
            {!! Form::submit('Create', ['class' => 'btn btn-default', 'name' => 'save']) !!}
            {!! Form::submit('Create And Download', ['class' => 'btn btn-primary', 'name' => 'saveAndDownload']) !!}
        </div>
    </div>


    {!! Form::close() !!}

@endsection

@section('footerScripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.multiSelect').multiselect({
                maxHeight: 400,
                enableHTML: true,
                includeSelectAllOption: true,
                numberDisplayed: 1,
                nonSelectedText: 'Pick customer(s)...',
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true
            });
        });
    </script>
@endsection