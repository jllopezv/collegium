@if (isset($saveandexit) && $saveandexit)
    <x-lopsoft.button.gray x-ref='btnUpdate' @click='$refs.group.focus()' icon='fa fa-check' text="ACTUALIZAR" wire:click='update(true)' class='ml-1' />
@else
    <x-lopsoft.button.gray x-ref='btnUpdate' @click='$refs.group.focus()' icon='fa fa-check' text="ACTUALIZAR" wire:click='update' class='ml-1' />
@endif
<x-lopsoft.button.danger x-ref='btnCancel' @click='$refs.group.focus()' icon='fa fa-times' text='CANCELAR' wire:click='goBack' class='ml-1' />
