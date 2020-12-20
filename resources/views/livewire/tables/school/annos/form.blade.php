<x-lopsoft.control.inputform
    wire:model.lazy='anno'
    id='anno'
    x-ref='anno'
    label="{{ transup('anno') }}"
    nextref='anno_start'
    classcontainer='w-full sm:w-2/3'
    requiredfield
    help="{{ transup('mandatory') }}"
    mode="{{ $mode }}"
/>

<div class='inline-flex flex-wrap items-center justify-start'>
    <div class='mr-2'>
        @livewire('controls.datepicker',[
            'mode'              =>  $mode,
            'id'                =>  'anno_start',
            'modelid'           =>  'anno_start',
            'label'             =>  transup('start'),
            'defaultvalue'      =>  getDateString($record->anno_start??null),
            'uid'               =>  'annostartcomponent',
            'eventname'         =>  'eventsetannostart',
            'requiredfield'     =>  true,
            'help'              =>  transup('mandatory')
        ])
    </div>
    <div>
        @livewire('controls.datepicker',[
            'mode'              =>  $mode,
            'id'                =>  'anno_end',
            'modelid'           =>  'anno_end',
            'label'             =>  transup('end'),
            'defaultvalue'      =>  getDateString($record->anno_end??null),
            'uid'               =>  'annoendcomponent',
            'eventname'         =>  'eventsetannoend',
            'requiredfield'     =>  true,
            'help'              =>  transup('mandatory')
        ])
    </div>
</div>
