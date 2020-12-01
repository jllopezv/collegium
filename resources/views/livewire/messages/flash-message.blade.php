<div>
        <div
            x-data="{ shown: false, timeout: null }"
            @showflashmessage.window="clearTimeout(timeout); (event.detail.msgid=='{{$msgid}}'?shown = true:shown=shown); timeout = setTimeout(() => { shown = false }, 3000);"
            @hideflashmessage.window="shown=false"
            x-show.transition.opacity.out.duration.1500ms="shown"
            class='flex items-center justify-center text-xl  text-white w-full text-center my-2 h-16 rounded-md
            {{ ($msgtype=='error' ? 'bg-red-500' : '' ) }}
            {{ ($msgtype=='success' ? 'bg-green-300 text-green-800' : '' ) }}
            {{ ($msgtype=='info' ? 'bg-blue-300 text-blue-800' : '' ) }}
            {{ ($msgtype=='warning' ? 'bg-orange-300 text-orange-800' : '' ) }}
            '>
            {{ $message  }}
        </div>
</div>
