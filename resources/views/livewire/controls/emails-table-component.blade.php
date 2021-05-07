<div>
    <div class='flex items-center justify-between'>
        <div class=''>
            <x-lopsoft.control.label class="mt-4 font-bold {{ $errors->has('email')?'text-red-600':'' }}" text='EMAILS'></x-lopsoft.control.label>
        </div>
        @if($mode!='show')
            <div wire:loading.remove wire:click='EmailAdd()' class=''>
                <i class='text-green-400 cursor-pointer hover:text-green-600 fa fa-plus-circle'></i>
            </div>
        @endif
    </div>
    @if($emails!=null &&  count($emails)>0)
        @foreach($emails as $email)
            <div class="p-2 mb-2 rounded-lg bg-cool-gray-50">
                <div class='flex items-center justify-start w-full '>
                    <div class='w-full '>
                        <div class='flex items-center justify-between w-full'>
                            <div class='w-full md:w-1/2 lg:w-3/4 flex items-center justify-start'>
                                <div class='w-6 pt-2 cursor-pointer'>
                                    @if($mode=='show')
                                        <a href="mailto:{{ $emails[$loop->index]['email'] }}" ><i class='text-green-400 far fa-envelope'></i></a>
                                    @endif
                                </div>
                                <div class='w-full'>
                                    <x-lopsoft.control.input
                                        wire:model.lazy='emails.{{$loop->index}}.email'
                                        class="bg-transparent {{ $errors->has('email_'.$emails[$loop->index]['email'])?'text-red-600':'' }}"
                                        classcontainer="w-full"
                                        placeholder='email@email.com'
                                        mode='{{ $mode }}'
                                    />
                                </div>
                            </div>
                            <div class='flex items-center justify-end'>
                                <div wire:loading.delay wire:target="emails.{{$loop->index}}.email, emails.{{$loop->index}}.description">
                                    <i class='fas fa-circle-notch fa-spin text-blue-500'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='pt-2 pb-0 pl-2'>
                        <div class='flex items-center justify-start'>
                            <div
                                @if($mode!='show')
                                    wire:click='EmailChangeNotif({{$loop->index}})'
                                @endif
                                class=''>
                                @if($emails[$loop->index]['notif'])
                                    <div class='tooltip'>
                                        <i class='cursor-pointer text-cool-gray-600 hover:text-gray-600 fas fa-paper-plane'></i>
                                        <span class='tooltiptext tooltiptext-down-left'>SE NOTIFICARÁ EN ESTE EMAIL</span>
                                    </div>
                                @else
                                    <div class='tooltip'>
                                        <i class='text-gray-400 cursor-pointer hover:text-gray-600 fas fa-paper-plane'></i>
                                        <span class='tooltiptext tooltiptext-down-left'>NO NOTIFICAR EN ESTE EMAIL</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class='flex items-center justify-start w-full'>
                    <div class='w-full pl-6'>
                        <x-lopsoft.control.input
                            wire:model.lazy='emails.{{$loop->index}}.description'
                            class='bg-transparent'
                            classcontainer="w-full"
                            placeholder='DESCRIPCIÓN'
                            mode='{{ $mode }}'
                        />
                    </div>
                    @if($mode!='show')
                        @if(!$loop->first || ($loop->first && sizeof($emails)>1))
                            <div class='pt-4 pb-0 pl-2'>
                                <div class='flex items-center justify-start'>
                                    <div wire:click='EmailDelete({{$loop->index}})' class=''>
                                        <i class='text-red-400 cursor-pointer hover:text-red-600 fa fa-minus-circle'></i>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        @endforeach
    @else
        <span class='pl-1 font-bold text-red-400'>NO HAY EMAILS DEFINIDOS</span>
    @endif
</div>

