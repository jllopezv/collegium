@props([
    'label'         => '',
    'sublabel'      => '',
    'placeholder'   => '',
    'disabled'      => false,
    'labelwidth'    => '',
    'labelclass'    => '',
    'id'            => Str::random(20),
    'showerror'     => true,
    'requiredfield' => false,
    'nextref'       => '',
    'help'          => '',
    'classcontainer' => '',
    'mode'          =>  'create',
    'fileid'        => Str::random(20),
    'modelid'       => '',
    'params'        => '',  // Extra params array like 'types:png,jpg'
    'classcomponent'=>'',
    'searchpos'     =>'before',
    'uuid'          =>  Str::random(20),
])

<div class='py-4 {{$classcomponent}}'>
    <x-lopsoft.control.label
        class="font-bold {{ $labelclass }} {{ $errors->has($id)?'text-red-600 ':''}}"
        text="{!! $label !!}"
        labelwidth="{{ $labelwidth }}"/>
    @if($sublabel)
        <div class='text-sm text-gray-400'>{{ $sublabel}}</div>
    @endif

    <div class='inline-flex items-center justify-start w-full'>
        @if($searchpos=='before')
            <div class='mt-2' wire:click="$emitTo('filemanager.filemanager','showFilemanager','{{$uuid}}', '{{  $modelid }}', '{{ $params }}')">
                <i class='text-blue-400 cursor-pointer hover:text-blue-500 fa fa-search fa-fw' ></i>
            </div>
        @endif
        <div class='w-full'>
            <x-lopsoft.control.input
                id="{{$id}}"
                name="{{$id}}"
                disabled='{{ $disabled ? "disabled" : "" }}'
                classcontainer="{{$classcontainer}}"
                {{ $attributes->merge([
                    'class' => ($errors->has($id)?'border-red-500':'')
                ]) }}
                placeholder='{{ $placeholder }}'
                nextref='{{$nextref}}'
                requiredfield='{{$requiredfield}}'
                help='{!! $help !!}'
                mode='{{ $mode }}'
            />
        </div>
        @if($searchpos=='after')
            <div class='mt-2' wire:click="$emitTo('filemanager.filemanager','showFilemanager','{{$uuid}}', '{{  $modelid }}', '{{ $params }}')">
                <i class='text-blue-400 cursor-pointer hover:text-blue-500 fa fa-search fa-fw' ></i>
            </div>
        @endif
    </div>

    @if($showerror)
        @if( $errors->has($id) )
            <div>
                <span class='text-red-500'>{{ ($errors->get($id))[0] }}</span>
            </div>
        @endif
    @endif

    {{ $slot }}

</div>
