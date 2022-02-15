@extends('adminlte::master')

@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@section('adminlte_css')
    @stack('css')
    @yield('css')
    <link rel="stylesheet" href="/css/admin_custom.css"> <!--My css stylesheet -->
@stop

@section('classes_body', $layoutHelper->makeBodyClasses())

@section('body_data', $layoutHelper->makeBodyData())

@section('body')
    <div class="wrapper">

        {{-- Top Navbar --}}
        @if($layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.navbar.navbar-layout-topnav')
        @else
            @include('adminlte::partials.navbar.navbar')
        @endif

        {{-- Left Main Sidebar --}}
        @if(!$layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.sidebar.left-sidebar')
        @endif

        {{-- Content Wrapper --}}
        @empty($iFrameEnabled)
            @include('adminlte::partials.cwrapper.cwrapper-default')
        @else
            @include('adminlte::partials.cwrapper.cwrapper-iframe')
        @endempty

        {{-- Footer --}}
        @hasSection('footer')
            @include('adminlte::partials.footer.footer')
        @endif

<!--My footer -->
<footer class="main-footer">
    <div class="text-center p-3">
        © 2022 Copyright:
        <a class="text-dark">Facultad de Informática y Ciencias Exactas, UNICA</a>
        </div>
</footer>

        {{-- Right Control Sidebar --}}
        @if(config('adminlte.right_sidebar'))
            @include('adminlte::partials.sidebar.right-sidebar')
        @endif

    </div>

    
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
    
    <!--My js scripts -->
    <script src="/js/admin_custom.js"></script> 
    <script>
        toastr.options ={
            "timeOut": 4000,
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "500",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",
            "tapToDismiss": true
            }


        @if(Session::has('message'))
            toastr.success("{{ session('message') }}");
        @endif
      
        @if(Session::has('error'))
            toastr.error("{{ session('error') }}");
        @endif
      
        @if(Session::has('info'))
            toastr.info("{{ session('info') }}");
        @endif
      
        @if(Session::has('warning'))
            toastr.warning("{{ session('warning') }}");
        @endif
      </script>
@stop
