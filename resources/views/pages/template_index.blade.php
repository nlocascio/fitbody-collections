@extends('layout')

@section('dashhead-subtitle', 'Settings')
@section('dashhead-title', 'Templates')

@section('content')
    <div class="flextable table-actions">
        <div class="flextable-item flextable-primary">
        </div>
        <div class="flextable-item">
            <div class="form-group">
                <div class="btn-group">
                    <a href="{{ route('template.create') }}" type="button" class="btn btn-default"
                       aria-haspopup="true" aria-expanded="false">
                        <span class="icon icon-plus"></span>
                    </a>
                </div>

                <div class="btn-group">
                    {!! Form::open(['method' => 'delete', 'class' => 'form-inline form-horizontal', 'id' => 'deleteTemplatesForm']) !!}
                    {!! Form::button('<span class="icon icon-trash"></span>', ['class' => 'btn btn-primary-outline', 'type' => 'submit']) !!}
                    {!! Form::hidden('letterId') !!}
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
                        <input type="checkbox" id="CheckAll">
                    </th>
                    <th class="col-sm-5">Name</th>
                    <th class="col-sm-5">Title</th>
                    <th class="col-sm-1"></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($templates as $template)
                    <tr>
                        <td class="text-center">
                            {!! Form::checkbox('listCheckbox', $template->id, false, ['class' => 'multiSelectCheckBox']) !!}
                        </td>
                        <td>
                            {{ $template['name'] }}
                        </td>
                        <td>{{ $template['title'] }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('template.edit', $template) }}" type="button"
                                   class="btn btn-xs btn-primary-outline"
                                   aria-haspopup="true" aria-expanded="false">
                                    <span class="icon icon-edit"></span>
                                </a></div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection


@section('footerScripts')
    <script>

        $('#deleteTemplatesForm').submit(function () {

            var listCheckboxIds = [];

            $('input:checkbox[name=listCheckbox]:checked').each(function () {
                listCheckboxIds.push($(this).val());
            });

            $('#deleteTemplatesForm').attr('action', '{{ route('template.destroy', '') }}/' + listCheckboxIds.join('+'));

        });

    </script>
@endsection