@extends('layout')

@section('dashhead-subtitle', 'Settings')
@section('dashhead-title', 'Template')

@section('content')
    <app-templates-create inline-template xmlns="http://www.w3.org/1999/html">
        <form class="form-horizontal">
            <input type="hidden" v-model="form.csrf_token" value="{{ csrf_token() }}">
            <input type="hidden" v-model="form.id" value="{{ $template->id }}">

            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Name</label>

                <div class="col-sm-10">
                    <input type="text"
                           class="form-control"
                           placeholder="Enter a name..."
                           v-model="form.name"
                           @if(isset($template->name))
                           value="{{ $template->name }}"
                            @endif
                    >
                </div>
            </div>

            <div class="form-group">
                <label for="title" class="col-sm-2 control-label">Title</label>

                <div class="col-sm-10">
                    <input type="text"
                           class="form-control"
                           placeholder="Enter a title..."
                           v-model="form.title"
                           @if(isset($template->title))
                           value="{{ $template->title }}"
                            @endif
                    >
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                    <summernote :content.sync="form.content">
                        @if(isset($template->content))
                            {{ $template->content }}
                        @endif
                    </summernote>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    @if (Route::is('template.create'))
                        <button class="btn btn-primary"
                                @click.stop.prevent="create"
                        >

                        Create
                        </button>
                    @endif
                    @if (Route::is('template.edit'))
                            <button class="btn btn-primary"
                                    @click.stop.prevent="update"
                            >

                            Save Changes
                        </button>
                        <a href="{{ URL::previous() }}" class="btn btn-default">Cancel</a>
                    @endif

                </div>
            </div>

            @{{ form | json }}

        </form>
    </app-templates-create>

@endsection


@section('footerScripts')
    {{--<script type="text/javascript">--}}
    {{--$('.wysiwyg').wysiwyg();--}}

    {{--@if(isset($template->content))--}}
    {{--        $('#templateContentEditor').html('{{ $template->content }}');--}}
    {{--@endif--}}

    {{--$('#createTemplateForm').submit(function () {--}}
    {{--$('#content').val($('#templateContentEditor').cleanHtml());--}}
    {{--})--}}
    {{--</script>--}}
@endsection
