<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.js" defer></script>
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('js/lib/jquery.min.js')}}"></script>
<script src="{{ asset('js/lib/toastr.min.js')}}"></script>
<script src="{{ asset('js/lib/noty.min.js')}}"></script>
<script src="{{ asset('js/lopsoft.js') }}"></script>


<script>

    var working=false;

</script>

@stack('scripts')

{{-- SOLO LOS FORMULARIOS QUE LO USEN
<script src="{{ asset('js/lib/ckeditor4/ckeditor.js') }}"></script>
<script src="{{ asset('js/lib/ckeditor4/styles.js') }}"></script>
--}}


