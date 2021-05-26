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

<div x-cloak x-show="$wire.mode=='create'" class='mt-8 font-bold bg-cool-gray-200 p-2'>DATOS QUE SE PASARÁN AL NUEVO AÑO</div>
<div x-cloak x-show="$wire.mode=='create'" class='bg-cool-gray-100 p-2'>
    <div class='px-2'>

        @livewire('controls.drop-down-table-component', [
            'model'         => \App\Models\School\Anno::class,
            'mode'          =>  'create',
            'filterraw'     => '',
            'sortorder'     => 'anno',
            'label'         =>  transup('fromyear'),
            'classdropdown' => 'w-full',
            'key'           => 'id',
            'field'         => 'anno',
            'defaultvalue'  => getAnnoSessionId(),//\App\Models\School\Anno::all()->last()->id??null,
            'eventname'     => 'eventsetanno',
            'uid'           => 'annocomponent',
            'modelid'       => 'process.anno_id',
            'isTop'         =>  false,
        ])
    </div>

    <div class='mt-4 p-2 flex flex-wrap items-start justify-start'>
        <div class='w-full md:w-1/2 p-1'>
            <div class='border-b border-gray-300 mb-2 font-bold'>
                ACADÉMICA
            </div>
            <div class=''>
                <x-lopsoft.control.checkbox
                    id='chk_periods'
                    label="{{ transup('periods') }}"
                    color='text-blue-400' classlabel='font-bold'
                    wire:model='process.periods'
                />
            </div>
            <div class=''>
                <x-lopsoft.control.checkbox
                    id='chk_levels'
                    label="{{ transup('levels') }}"
                    color='text-blue-400' classlabel='font-bold'
                    wire:model='process.levels'
                />
            </div>
            <div class=''>
                <x-lopsoft.control.checkbox
                    id='chk_grades'
                    label="{{ transup('grades') }}"
                    color='text-blue-400' classlabel='font-bold'
                    wire:model='process.grades'
                />
            </div>
            <div class=''>
                <x-lopsoft.control.checkbox
                    id='chk_sections'
                    label="{{ transup('sections') }}"
                    color='text-blue-400' classlabel='font-bold'
                    wire:model='process.sections'
                />
            </div>
            <div class=''>
                <x-lopsoft.control.checkbox
                    id='chk_batches'
                    label="{{ transup('batches') }}"
                    color='text-blue-400' classlabel='font-bold'
                    wire:model='process.batches'
                />
            </div>
            <div class=''>
                <x-lopsoft.control.checkbox
                    id='chk_modalities'
                    label="{{ transup('modalities') }}"
                    color='text-blue-400' classlabel='font-bold'
                    wire:model='process.modalities'
                />
            </div>
            <div class=''>
                <x-lopsoft.control.checkbox
                    id='chk_subjects'
                    label="{{ transup('schoolsubjects') }}"
                    color='text-blue-400' classlabel='font-bold'
                    wire:model='process.subjects'
                />
            </div>
        </div>
        <div class='w-full md:w-1/2 p-1'>
            <div class='border-b border-gray-300 mb-2 font-bold'>
                CRM
            </div>
            <div class=''>
                <x-lopsoft.control.checkbox
                    id='chk_employees'
                    label="{{ transup('employees') }}"
                    color='text-blue-400' classlabel='font-bold'
                    wire:model='process.employees'
                />
            </div>
        </div>
    </div>
    <div class='text-red-400 text-sm font-bold mt-4'>USTED PODRÁ LUEGO ACTIVAR INDIVIDUALMENTE LOS QUE NO SE PASEN</div>
    <div class='text-red-400 text-sm font-bold'>PARA LOS ESTUDIANTES DEBERÁ ELEGIR LA OPCIÓN DE 'PROMOVER ESTUDIANTES' UNA VEZ CREADO EL AÑO</div>
</div>
