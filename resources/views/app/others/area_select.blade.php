@extends('adminlte::page')

@section('title', 'Documentos por Area')

@section('content_header')
    <h1>Seleccione el area</h1>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="/css/accordion_custom.css">
@stop


@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <ul id="accordion" class="accordion">
                    @foreach ($type_areas as $type_area)
                        <li>
                            <div class="link">{{ $type_area->name }}<i class="fa fa-chevron-down"></i></div>
                            <ul class="submenu">
                                @foreach ($type_area->areas as $area)
                                <li><a href="{{ route('files.files_by_area', $area->id) }}">{{ $area->name }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </div>
@endsection

@section('js')
    <script>
        $(function() {
            var Accordion = function(el, multiple) {
            this.el = el || {};
            this.multiple = multiple || false;

            var links = this.el.find('.link');

            links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
            }

            Accordion.prototype.dropdown = function(e) {
            var $el = e.data.el;
            $this = $(this),
            $next = $this.next();

            $next.slideToggle();
            $this.parent().toggleClass('open');

            if (!e.data.multiple) {
            $el.find('.submenu').not($next).slideUp().parent().removeClass('open');
            };
            }

            var accordion = new Accordion($('#accordion'), false);
            });
    </script>
@stop
