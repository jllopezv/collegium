<x-lopsoft.link.gray x-ref='btnEdit' link="{{ route($table.'.edit', $recordid ) }}" icon='fa fa-pencil-alt' text='MODIFICAR' class='ml-1' />
<x-lopsoft.button.danger x-ref='btnCancel'  icon='fa fa-times' text='CANCELAR' wire:click='goBack'  class='ml-1' />

