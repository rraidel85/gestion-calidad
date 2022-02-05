@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    @auth
        <h1>Bienvenido, {{ auth()->user()->name }}</h1>
    @endauth
    @guest
        <h1>Bienvenido, Invitado</h1>
    @endguest
@stop

@section('content')

@endsection


{{-- @section('js')
    @stack('scripts')
            
            
    @if (session()->has('success')) 
    <script>
        const notyf = new Notyf({dismissible: true})
        notyf.success('{{ session('success') }}')
    </script> 
    @endif

    <script>
        /* Simple Alpine Image Viewer */
        function imageViewer(src = '') {
            return {
                imageUrl: src,

                refreshUrl() {
                    this.imageUrl = this.$el.getAttribute("image-url")
                },

                fileChosen(event) {
                    this.fileToDataUrl(event, src => this.imageUrl = src)
                },

                fileToDataUrl(event, callback) {
                    if (! event.target.files.length) return

                    let file = event.target.files[0],
                        reader = new FileReader()

                    reader.readAsDataURL(file)
                    reader.onload = e => callback(e.target.result)
                },
            }
        }
    </script>
@stop --}}