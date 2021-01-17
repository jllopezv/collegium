<div class='flex items-center justify-end'>
    <div >
        <x-lopsoft.button.gray      id='btnCreate' x-ref='btnCreate'   @click="{{ $nextref }}" icon='fa fa-check'  text='CREAR'    wire:click='initStore'  class='ml-1'/>
    </div>
    <div>
        <x-lopsoft.button.danger    id='btnCancel' x-ref='btnCancel'   @click="{{ $nextref }}" icon='fa fa-times' text='CANCELAR' wire:click='goBack' class='ml-1' />
    </div>
</div>
