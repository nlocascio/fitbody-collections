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
