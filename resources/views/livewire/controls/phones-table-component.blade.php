<div>
    <div class='flex items-center justify-between'>
        <div class=''>
            <x-lopsoft.control.label class="mt-4 font-bold" text='TELÉFONOS'></x-lopsoft.control.label>
        </div>
        @if($mode!='show')
            <div wire:click='PhoneAdd()' class=''>
                <i class='text-green-400 cursor-pointer hover:text-green-600 fa fa-plus-circle'></i>
            </div>
        @endif
    </div>
    @if($phones!=null && count($phones)>0)
        @foreach($phones as $phone)
            <div class='p-2 mb-2 rounded-lg bg-cool-gray-50'>
                <div class='w-full md:w-60'>
                    <div class='flex items-center justify-start'>
                        <div class='w-10 cursor-pointer'>
                            @if($mode=='show')
                                <a href="tel:{{ $phones[$loop->index]['phone'] }}" ><i class='text-green-400 fa fa-phone'></i></a>
                            @endif
                        </div>
                        <div class=''>
                            <x-lopsoft.control.input
                                wire:model.lazy='phones.{{$loop->index}}.phone'
                                class='bg-transparent'
                                classcontainer="w-full"
                                placeholder='NÚMERO'
                                mode='{{ $mode }}'
                            />
                        </div>
                    </div>
                </div>
                <div class='flex items-center justify-start w-full'>
                    <div class='w-full pl-10'>
                        <x-lopsoft.control.input
                            wire:model.lazy='phones.{{$loop->index}}.description'
                            class="bg-transparent"
                            classcontainer="w-full"
                            placeholder='DESCRIPCIÓN'
                            mode='{{ $mode }}'
                        />
                    </div>
                    @if($mode!='show')
                        @if(!$loop->first || ($loop->first && sizeof($phones)>1))
                            <div class='pt-4 pb-0 pl-2'>
                                <div class='flex items-center justify-start'>
                                    <div wire:click="PhoneDelete({{$loop->index}})" class=''>
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
        <span class='pl-1 font-bold text-red-400'>NO HAY TELÉFONOS DEFINIDOS</span>
    @endif
</div>
