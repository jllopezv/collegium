                    @livewire('messages.flash-message', ['msgid' => $flassmessage] )
                    <div class='mt-4 text-right'>
                        @includeWhen($mode=='create','livewire.partials.createbuttons', ['nextref' => '$refs.'.$firstref.'.focus()'])
                        @includeWhen($mode=='edit', 'livewire.partials.editbuttons', ['nextref' => '$refs.'.$firstref.'.focus()'])
                        @includeWhen($mode=='show', 'livewire.partials.showbuttons', ['nextref' => '$refs.'.$firstref.'.focus()'])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
