<x-lopsoft.button.gray id='btnSave' x-ref='btnSave' @click='$refs.{{ $firstref }}.focus()' icon='fa fa-save' text="GUARDAR" wire:click='initUpdate(true)' class='ml-1' />
<x-lopsoft.button.gray id='btnUpdate' x-ref='btnUpdate' @click='$refs.{{ $firstref }}.focus()' icon='fa fa-sync' text="ACTUALIZAR" wire:click='initUpdate' class='ml-1' />
<x-lopsoft.button.danger id='btnCancel' x-ref='btnCancel' icon='fa fa-times' text='CANCELAR' wire:click='goBack' class='ml-1' />
