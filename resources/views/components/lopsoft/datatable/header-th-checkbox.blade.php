<th {{ $attributes->merge([ 'class' => ' text-left px-4 py-2 ' ]) }}>
    <div class='inline-flex'>
        <div class='tooltip'>
            <input id='tablecheckbox' wire:model='rowselectpage' type="checkbox" class="form-checkbox h-5 w-5 text-green-400 cursor-pointer
                        hover:shadow-none hover:border-gray-500
                        active:shadow-none
                        focus:shadow-none focus:border-gray-500">
            <span class='tooltiptext tooltiptext-down-right'>SELECCIONAR TODA LA PÁGINA</span>
        </div>
        <div class='tooltip'>
            <input id='tablecheckbox' wire:model='rowselectall' type="checkbox" class="ml-1 form-checkbox h-5 w-5 text-green-600 cursor-pointer
            hover:shadow-none hover:border-gray-500
            active:shadow-none
            focus:shadow-none focus:border-gray-500">
            <span class='tooltiptext tooltiptext-down-right'>SELECCIONAR TODOS</span>
        </div>
    </div>
</th>
