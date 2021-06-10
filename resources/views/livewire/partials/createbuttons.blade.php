<div class='flex items-center justify-end'>
    @includeIf('models.'.$module.'.'.$table.'.createbuttons')
    <div >
        <x-lopsoft.button.gray  id='btnCreate' x-ref='btnCreate'  @click="$refs.{{ $firstref }}.focus()" icon='fa fa-check'  text='CREAR'    wire:click='initStore'  class='ml-1'/>
    </div>
    <div>
        <x-lopsoft.button.danger    id='btnCancel' x-ref='btnCancel' icon='fa fa-times' text='CANCELAR' wire:click='goBack' class='ml-1' />
    </div>
</div>
