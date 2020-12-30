@extends('lopsoft.layouts.page')

@section('content')
    <div class='w-full h-full'>
        @livewire('filemanager.filemanager', ['uuid' => 'filemanager-browser', 'multiselect' => false, 'root' => '/', 'allowedmimetypes' => '' ])
    </div>
@endsection
