<div
    class="py-4"
    x-data='{}'
    x-init="editor_{{$uuid}}.setData($wire.default)">
    <label class="block mb-2 font-bold">
        {{ $label }}
        @if($sublabel!="")
            <div class='text-sm font-normal text-gray-400'>{{ $sublabel}}</div>
        @endif
    </label>
    <div wire:ignore wire:key='{{ $uuid }} ' >
        @if($mode!='show')
            <div id='ckeditor_{{$uuid}}'></div>
        @else
            {!! $content !!}
        @endif
        {{--<div id='loading_{{ $uuid }}' class='absolute bottom-0 z-50 hidden text-red-600 right-4'><i class="fas fa-circle-notch fa-spin"></i> Saving...</div>--}}
    </div>
</div>



<script>

        // CKEditor4
        let lastchange_{{$uuid}}=true;
        let editor_{{$uuid}}=CKEDITOR.replace('ckeditor_{{$uuid}}', {
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


        // editor.on('blur',function(){
        //     Livewire.emit('richeditor-update','{{$modelid}}',editor.getData());
        // });

        // editor.on('blur',function(){
        //     $("#loading_{{$uuid}}").show();
        //     $("#btnCreate").hide();
        //     $("#btnUpdate").hide();
        //     if (lastchange_{{$uuid}})
        //     {
        //         lastchange_{{$uuid}}=false;
        //         setTimeout(function() {
        //             Livewire.emit('richeditor-update','{{$modelid}}',editor.getData());
        //             // lastchange_{{$uuid}}=true;
        //             // $("#btnCreate").show();
        //         },{{ config('lopsoft.richeditor_timeout') }} ); // Update timeout
        //     }
        // });

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
        })

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



</script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML"></script>






{{--
<script>


// CKEDITOR.replace('ckeditor_{{$uuid}}', {

//     filebrowserUploadUrl: "{{route('ckeditor1.upload', ['_token' => csrf_token() ])}}",
//     filebrowserUploadMethod: 'form',
//     filebrowserImageBrowseUrl: "{{route('ckeditor1.upload', ['_token' => csrf_token() ])}}",

// });

    // let editor;

    // ClassicEditor
    //     .create( document.querySelector( '#ckeditor_{{$uuid}}' ), {
    //         toolbar: [ 'heading', '|',
    //     'fontfamily', 'fontsize', '|',
    //     'fontColor', 'fontBackgroundColor', '|',
    //     'bold', 'italic', 'strikethrough', 'subscript', 'superscript', 'link', '|',
    //     'outdent', 'indent', '|',
    //     'bulletedList', 'numberedList', 'todoList', '|',
    //     'code', 'codeBlock', '|',
    //     'imageUpload', 'imageInsert','blockQuote', '|',
    //     'undo', 'redo', 'ckfinder' ],
    //         heading: {
    //             options: [
    //                 { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
    //                 { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
    //                 { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
    //             ]
    //         },
    //         image: {
    //             toolbar: [ 'imageTextAlternative' ]
    //         },
    //         plugins: [ SimpleUploadAdapter  ],
    //         simpleUpload: {
    //                         The URL that the images are uploaded to.
    //                         uploadUrl: 'http://example.com',

    //                         Enable the XMLHttpRequest.withCredentials property.
    //                         withCredentials: true,

    //                     Headers sent along with the XMLHttpRequest to the upload server.
    //                     headers: {
    //                         'X-CSRF-TOKEN': 'CSRF-Token',
    //                         Authorization: 'Bearer <JSON Web Token>'
    //                     }
    //                 }
    //     } )
    //     .then(instance_editor => {
    //         editor.model.document.on('change:data', () => {
    //             document.querySelector('#txtckeditor').value=editor.getData();
    //         });
    //         editor=instance_editor;
    //         instance_editor.ui.focusTracker.on('change:isFocused', ( evt, name, isFocused ) => {
    //             if ( !isFocused ) {
    //                 Livewire.emit('richeditor-update','{{$uuid}}',instance_editor.getData());
    //                 console.log( editor.getData() );
    //             }
    //         });
    //     })
    //     .catch( error => {
    //         console.log( error );
    //     });
</script>


 --}}

{{--
 <script>

    let uuid="{{ $uuid }}";

    editormce=tinymce.init({
    selector: '#tinymce_{{$uuid}}',
    plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
    menubar: 'file edit view insert format tools table help',
    toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl | myCustomToolbarButton',
    setup: function (editor) {
        editor.ui.registry.addButton('myCustomToolbarButton', {
        text: 'My Custom Button',
        onAction: function () {
            Livewire.emit('showFilemanager',uuid, 'test', 'types:jpg,png,jpeg');
        }
        });
        editor.on('blur', function(e) {
            content=tinymce.get('tinymce_{{$uuid}}').getContent('raw');
            tinymce.get('tinymce_{{$uuid}}').setContent(content);
            Livewire.emit('richeditor-update','body',content);
        });
    }
    });


    window.addEventListener('filemanagerselect', event => {
        if (event.detail.uuid==uuid)
        {
            console.log(event.detail.file);
            tinymce.execCommand('mceInsertContent', false, '<img alt="Smiley face" height="42" width="42" src="' +  event.detail.file[0]['url'] + '"/>');
        }

    });



</script> --}}
