<div
    class="py-4"
    x-data='{}'
    {{--x-init="editor_{{$uuid}}.setData($wire.default)--}}">
    <label class="block mb-2 font-bold">
        {{ $label }}
        @if($sublabel!="")
            <div class='text-sm font-normal text-gray-400'>{{ $sublabel}}</div>
        @endif
    </label>
    <div wire:ignore wire:key='{{ $uuid }} ' >
        @if($mode!='show')
            <div id='ckeditor_{{$uuid}}'><i class='fas fa-spinner fa-pulse'></i> CARGANDO DATOS... </div>
        @else
            {!! $content !!}
        @endif
        {{--<div id='loading_{{ $uuid }}' class='absolute bottom-0 z-50 hidden text-red-600 right-4'><i class="fas fa-circle-notch fa-spin"></i> Saving...</div>--}}
    </div>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML"></script>

<script>

        setTimeout(function() {
        // CKEditor4
        var lastchange_{{$uuid}}=true;
        var editor_{{$uuid}}=CKEDITOR.replace('ckeditor_{{$uuid}}', {
            height: 500,
            width: '100%',
            language: 'es',
            removePlugins: 'iframe,elementspath',
            extraPlugins: 'image2,mathjax,youtube',
            allowedContent: true,
            resize_enabled: false,
            fontawesome : {
                'path': '/css/fontawesome/all.min.css',
                'version': '5.13.0',
                'edition': 'free',
                'element': 'i'
            },
            toolbar:[
                { name: 'toolbar', items:  [
                                            @isAdmin
                                            'Source','-',
                                            'ShowBlocks','-',
                                            @endisAdmin
                                            'Format', 'FontSize',
                                            '-','TextColor', 'BGColor','Bold', 'Italic', 'Underline',
                                            '-', 'CopyFormatting', 'RemoveFormat','NumberedList', 'BulletedList',
                                            '-', 'Blockquote',
                                            '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock',
                                            '-', 'Link', 'Unlink',
                                            '-', 'Table', '-', 'Iframe', 'Image', 'Youtube', 'filemanagerLopsoftButton', 'fontawesome5','Mathjax',
                                            '-', 'Maximize',],
                },
            ],
            removeDialogTabs: 'image:advanced;link:advanced',

        });

        CKEDITOR.addCss(".image2-align-right{float:right;}");
        CKEDITOR.addCss(".image2-align-left{float:left;}  p.image2-align-center {text-align: center;} p.image2-align-center img { margin: auto;display: inline-block;}");
        CKEDITOR.addCss(".cke_editable{cursor:text;font-size: 16px; font-family: Verdana, sans-serif; } .cke_editable p { margin: 0 !important; }");

        CKEDITOR.dtd.$removeEmpty['i'] = false;
        CKEDITOR.dtd.$removeEmpty['span'] = false;

        editor_{{$uuid}}.addCommand("filemanagerLopsoft", { // create named command
            exec: function(edt) {
                Livewire.emit('showFilemanager',"{{$uuid}}", "{{$modelid}}", 'types:jpg,png,jpeg');
            }
        });

        editor_{{$uuid}}.ui.addButton('filemanagerLopsoftButton', { // add new button and bind our command
            label: "Filemanager",
            command: 'filemanagerLopsoft',
            toolbar: 'insert',
            icon: "{{ asset('storage/fileicons/image.png') }}"
        });

        // IMPORTANTE!!!! CARGA DATOS UNA VEZ QUE LA INSTANCIA DEL CKEDITOR ESTA LISTA

        editor_{{$uuid}}.on( "instanceReady", function( event ){
            //console.log('Inicializado {{$uuid}}');
            //editor_{{$uuid}}.updateElement();
            Livewire.emit('setdefault', '{{$modelid}}');

        });

        /*
        editor_{{$uuid}}.on( "dataReady", function( event ){
            console.log('data ready {{$uuid}}');
            try
            {
                editor_{{$uuid}}.updateElement();
                dataeditor=editor_{{$uuid}}.getData();
                console.log("Data getted: "+dataeditor);
            }
            catch(e)
            {
                console.log("ERRORRRR");
                console.error(e);
            }

        });*/

        window.addEventListener('filemanagerselect', event => {
            if (event.detail.uuid=='{{$uuid}}')
            {
                img=new Image;
                img.src=event.detail.file[0]['url'];
                img.onload = function() {
                    editor_{{$uuid}}.insertHtml('<img alt="" src="' +  event.detail.file[0]['url'] + '"  />');
                    //editor_{{$uuid}}.insertHtml('<img alt="" src="' +  event.detail.file[0]['url'] + '" style="width:'+this.width+'px;height:'+this.height+'px" />');
                    //editor_{{$uuid}}.insertHtml('<img alt="" src="' +  event.detail.file[0]['url'] + '" style="width:'+this.width+'px;height: auto" />');
                }

            }

        });

        window.addEventListener('richeditor-setdefault', event => {
            if (event.detail.modelid=="{{$modelid}}")
            {
                editor_{{$uuid}}.setData(event.detail.content);
            }
        });

        window.addEventListener('richeditor-updated', event => {
            if (event.detail.modelid=="{{$modelid}}")
            {
                $("#loading_{{$uuid}}").hide();
                lastchange_{{$uuid}}=true;
                $("#btnCreate").show();
                $("#btnUpdate").show();
            }
        });

        window.addEventListener('richeditor-request-update', event => {
            if (event.detail.modelid=="{{$modelid}}")
            {
                $("#loading_{{$uuid}}").show();
                $("#btnCreate").hide();
                $("#btnUpdate").hide();
                Livewire.emit('richeditor-update','{{$modelid}}',editor_{{$uuid}}.getData(), event.detail.command, event.detail.param );
            }
        });

        },{{ config('lopsoft.timeout_ckeditor') }});  // Wait to load all ok.



</script>
