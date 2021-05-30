<x-lopsoft.control.inputform
wire:model.lazy='teacher'
id='teacher'
x-ref='teacher'
label="{{ transup('teacher') }}"
sublabel='Nombre que le aparecerá a los estudiantes'
class='w-full'
autofocus
classcontainer='w-full'
requiredfield
help="{{ transup('mandatory_unique') }}"
mode="{{ $mode }}"
nextref='btnCreate'
/>

<div class='w-full'>
    @livewire('controls.drop-down-table-component', [
        'model'         => \App\Models\Crm\Employee::class,
        'mode'          => $mode,
        'filterraw'     => '',
        'sortorder'     => 'employee',
        'label'         => transup('employee'),
        'classdropdown' => 'w-full mr-2',
        'key'           => 'id',
        'field'         => 'employee',
        'defaultvalue'  =>  $record->employee_id??null,
        'eventname'     => 'eventsetemployee',
        'uid'           => 'employeecomponent',
        'modelid'       => 'employee_id',
        'isTop'         =>  true,
        'requiredfield' =>  true,
        'help'          =>  transup('mandatory'),
        'linknew'       =>  Auth::user()->hasAbility('employees.create')?route('employees.create'):'',
        'template'      => 'components.lopsoft.dropdown.employees',
    ])
</div>

<x-lopsoft.control.tabs minheight='600px'>
<x-slot name='tabs'>
    <x-lopsoft.control.tabs-index title='USUARIO' index='1'></x-lopsoft.control.tabs-index>
</x-slot>
<x-slot name='tabscontent'>
    <x-lopsoft.control.tabs-content index='1'>
        @include('components.lopsoft.auth.userprofile', ['emaildropdown' => false])
    </x-lopsoft.control.tabs-content>
</x-slot>
</x-lopsoft.control.tabs>
