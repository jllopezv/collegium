@extends('lopsoft.layouts.voidpage')

@section('content')

    @php

        //echo Cache::get('roles.permissions');

        $storage = \Cache::getStore(); // will return instance of FileStore
        $filesystem = $storage->getFilesystem(); // will return instance of Filesystem
        $dir = (\Cache::getDirectory());
        $keys = [];
        foreach ($filesystem->allFiles($dir) as $file1) {

            if (is_dir($file1->getPath())) {

                foreach ($filesystem->allFiles($file1->getPath()) as $file2) {
                    $keys = array_merge($keys, [$file2->getRealpath() => unserialize(substr(\File::get($file2->getRealpath()), 10))]);
                }
            }
            else {

            }
        }
    @endphp

    @foreach($keys as $key)
        <div class='text-white'>{{ $key }}</div>
        <div class='text-red-700'>----------------------------------------------------------------------------</div>
    @endforeach

@endsection
