@extends('lopsoft.layouts.page')

@section('content')

    @include('livewire.partials.states.commonheader', ['mode' => 'edit'] )

    <div class='justify-center inline-block w-full p-2 mt-4 items-top'>

        <div class='w-full mx-auto'>
            @livewire('website.website-post-component', [
                'table'         =>  '{{ $table }}',
                'model'         =>  $model,
                'mode'          =>  'edit',
                'title'         =>  $title,
                'subtitle'      =>  $subtitle,
                'recordid'      =>  $recordid,
                ])
        </div>

    </div>

    <div class='h-32'></div>

@endsection

@push('scripts')
    <script src="{{ asset('js/lib/ckeditor4/ckeditor.js') }}"></script>
    <script src="{{ asset('js/lib/ckeditor4/styles.js') }}"></script>
@endpush
