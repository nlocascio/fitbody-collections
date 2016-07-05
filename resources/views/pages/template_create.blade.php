@extends('layout')

@section('dashhead-subtitle', 'Settings')
@section('dashhead-title', 'Template')

@section('content')
<app-templates-create inline-template>
    <div>
        @if (Route::is('template.create'))
            {!! Form::open(['method' => 'post', 'class' => 'form-horizontal',' id' => 'createTemplateForm', 'url' => route('template.store')]) !!}
        @elseif(Route::is('template.edit'))
            {!! Form::open(['method' => 'put', 'class' => 'form-horizontal',' id' => 'createTemplateForm', 'url' => route('template.update', $template)]) !!}
        @endif

        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Name</label>

            <div class="col-sm-10">
                {!! Form::text('name', (isset($template->name)) ? $template->name : null, ['class' => 'form-control', 'placeholder' => 'Enter a name...', 'id' => 'name']) !!}
            </div>
        </div>

        <div class="form-group">
            <label for="title" class="col-sm-2 control-label">Title</label>

            <div class="col-sm-10">
                {!! Form::text('title', (isset($template->title)) ? $template->title : null, ['class' => 'form-control', 'placeholder' => 'Enter a title...', 'id' => 'title']) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
                <div id="summernote" class="form-control">{{ isset($template->content) ? $template->content : null }}</div>
            </div>
        </div>

        {{--<div class="form-group">--}}
            {{--<label for="templateContent" class="col-sm-2 control-label">Content</label>--}}

            {{--<div class="col-sm-10">--}}
                {{--<div class="btn-toolbar" data-role="editor-toolbar" data-target="#templateContentEditor">--}}
                    {{--<div class="btn-group">--}}
                        {{--<a class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" title="" data-original-title="Font"><i--}}
                                    {{--class="fa fa-font"></i><b class="caret"></b></a>--}}
                        {{--<ul class="dropdown-menu">--}}
                            {{--<li><a data-edit="fontName Serif" style="font-family:'Serif'">Serif</a></li>--}}
                            {{--<li><a data-edit="fontName Sans" style="font-family:'Sans'">Sans</a></li>--}}
                            {{--<li><a data-edit="fontName Arial" style="font-family:'Arial'">Arial</a></li>--}}
                            {{--<li><a data-edit="fontName Arial Black" style="font-family:'Arial Black'">Arial Black</a></li>--}}
                            {{--<li><a data-edit="fontName Courier" style="font-family:'Courier'">Courier</a></li>--}}
                            {{--<li><a data-edit="fontName Courier New" style="font-family:'Courier New'">Courier New</a></li>--}}
                            {{--<li><a data-edit="fontName Comic Sans MS" style="font-family:'Comic Sans MS'">Comic Sans MS</a>--}}
                            {{--</li>--}}
                            {{--<li><a data-edit="fontName Helvetica" style="font-family:'Helvetica'">Helvetica</a></li>--}}
                            {{--<li><a data-edit="fontName Impact" style="font-family:'Impact'">Impact</a></li>--}}
                            {{--<li><a data-edit="fontName Lucida Grande" style="font-family:'Lucida Grande'">Lucida Grande</a>--}}
                            {{--</li>--}}
                            {{--<li><a data-edit="fontName Lucida Sans" style="font-family:'Lucida Sans'">Lucida Sans</a></li>--}}
                            {{--<li><a data-edit="fontName Tahoma" style="font-family:'Tahoma'">Tahoma</a></li>--}}
                            {{--<li><a data-edit="fontName Times" style="font-family:'Times'">Times</a></li>--}}
                            {{--<li><a data-edit="fontName Times New Roman" style="font-family:'Times New Roman'">Times New--}}
                                    {{--Roman</a></li>--}}
                            {{--<li><a data-edit="fontName Verdana" style="font-family:'Verdana'">Verdana</a></li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                    {{--<div class="btn-group">--}}
                        {{--<a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" title="" data-original-title="Font Size"><i--}}
                                    {{--class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>--}}
                        {{--<ul class="dropdown-menu">--}}
                            {{--<li><a data-edit="fontSize 5"><font size="5">Huge</font></a></li>--}}
                            {{--<li><a data-edit="fontSize 3"><font size="3">Normal</font></a></li>--}}
                            {{--<li><a data-edit="fontSize 1"><font size="1">Small</font></a></li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                    {{--<div class="btn-group">--}}
                        {{--<a class="btn  btn-default btn-sm" data-edit="bold" title="" data-original-title="Bold (Ctrl/Cmd+B)"><i--}}
                                    {{--class="fa fa-bold"></i></a>--}}
                        {{--<a class="btn  btn-default btn-sm" data-edit="italic" title="" data-original-title="Italic (Ctrl/Cmd+I)"><i--}}
                                    {{--class="fa fa-italic"></i></a>--}}
                        {{--<a class="btn  btn-default btn-sm" data-edit="strikethrough" title="" data-original-title="Strikethrough"><i--}}
                                    {{--class="fa fa-strikethrough"></i></a>--}}
                        {{--<a class="btn btn-default btn-sm" data-edit="underline" title="" data-original-title="Underline (Ctrl/Cmd+U)"><i--}}
                                    {{--class="fa fa-underline"></i></a>--}}
                    {{--</div>--}}
                    {{--<div class="btn-group">--}}
                        {{--<a class="btn btn-default btn-sm" data-edit="insertunorderedlist" title="" data-original-title="Bullet list"><i--}}
                                    {{--class="fa fa-list-ul"></i></a>--}}
                        {{--<a class="btn btn-default btn-sm" data-edit="insertorderedlist" title="" data-original-title="Number list"><i--}}
                                    {{--class="fa fa-list-ol"></i></a>--}}
                        {{--<a class="btn btn-default btn-sm" data-edit="outdent" title="" data-original-title="Reduce indent (Shift+Tab)"><i--}}
                                    {{--class="fa fa-indent"></i></a>--}}
                        {{--<a class="btn btn-default btn-sm" data-edit="indent" title="" data-original-title="Indent (Tab)"><i--}}
                                    {{--class="fa fa-outdent"></i></a>--}}
                    {{--</div>--}}
                    {{--<div class="btn-group">--}}
                        {{--<a class="btn btn-default btn-sm" data-edit="justifyleft" title=""--}}
                           {{--data-original-title="Align Left (Ctrl/Cmd+L)">--}}
                            {{--<i class="fa fa-align-left"></i></a>--}}
                        {{--<a class="btn btn-default btn-sm" data-edit="justifycenter" title="" data-original-title="Center (Ctrl/Cmd+E)"><i--}}
                                    {{--class="fa fa-align-center"></i></a>--}}
                        {{--<a class="btn btn-default btn-sm" data-edit="justifyright" title="" data-original-title="Align Right (Ctrl/Cmd+R)"><i--}}
                                    {{--class="fa fa-align-right"></i></a>--}}
                    {{--</div>--}}
                    {{--<div class="btn-group">--}}
                        {{--<a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" title="" data-original-title="Hyperlink"><i--}}
                                    {{--class="fa fa-link"></i></a>--}}

                        {{--<div class="dropdown-menu input-append">--}}
                            {{--<input class="span2" placeholder="URL" type="text" data-edit="createLink">--}}
                            {{--<button class="btn" type="button">Add</button>--}}
                        {{--</div>--}}
                        {{--<a class="btn btn-default btn-sm" data-edit="unlink" title="" data-original-title="Remove Hyperlink"><i--}}
                                    {{--class="fa fa-cut"></i></a>--}}

                    {{--</div>--}}

                    {{--<div class="btn-group">--}}
                        {{--<a class="btn btn-default btn-sm" title="" id="pictureBtn"--}}
                           {{--data-original-title="Insert picture (or just drag &amp; drop)">--}}
                            {{--<i class="fa fa-file-image-o"></i></a>--}}
                        {{--<input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage"--}}
                               {{--style="opacity: 0; position: absolute; top: 0px; left: 0px; width: 36px; height: 30px;">--}}
                    {{--</div>--}}
                    {{--<div class="btn-group">--}}
                        {{--<a class="btn btn-default btn-sm" data-edit="undo" title="" data-original-title="Undo (Ctrl/Cmd+Z)"><i--}}
                                    {{--class="fa fa-undo"></i></a>--}}
                        {{--<a class="btn btn-default btn-sm" data-edit="redo" title="" data-original-title="Redo (Ctrl/Cmd+Y)"><i--}}
                                    {{--class="fa fa-repeat"></i></a>--}}
                    {{--</div>--}}
                    {{--<input type="text" data-edit="inserttext" id="voiceBtn" x-webkit-speech="" style="display: none;">--}}
                {{--</div>--}}

                {{--<div id="templateContentEditor" class="form-control wysiwyg">--}}
                    {{--@if(isset($template->content))--}}
                        {{--{!! $template->content !!}--}}
                    {{--@endif--}}
                {{--</div>--}}
                {{--{!! Form::hidden('content', null, ['id' => 'content']) !!}--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                @if (Route::is('template.create'))
                    {!! Form::button('Create', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
                @endif
                @if (Route::is('template.edit'))
                    {!! Form::button('Save Changes', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
                    <a href="{{ URL::previous() }}" class="btn btn-default">Cancel</a>
                @endif

            </div>
        </div>


        {!! Form::close() !!}
    </div>
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
