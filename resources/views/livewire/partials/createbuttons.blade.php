<x-lopsoft.button.gray      x-ref='btnCreate'   @click="{{ $nextref }}" icon='fa fa-check'  text='CREAR'    wire:click='store'  class='ml-1' />
<x-lopsoft.button.danger    x-ref='btnCancel'   @click="{{ $nextref }}" icon='fa fa-times' text='CANCELAR' wire:click='goBack' class='ml-1' />
