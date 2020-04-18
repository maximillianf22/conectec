@extends ('templates.default.layouts.default')

@section ('title','Mi perfil')

@section('head')
    <style>
        .content-wrapper{
            background-color: #1f1f1f;
            background-image: inherit;
        }
        .fade-scale {
            transform: scale(0);
            opacity: 0;
            -webkit-transition: all .25s linear;
            -o-transition: all .25s linear;
            transition: all .25s linear;
        }

        .fade-scale.in {
            opacity: 1;
            transform: scale(1);
        }

        .modal.in .modal-dialog {
            -webkit-transform: translate(0, calc(50vh - 50%));
            -ms-transform: translate(0, 50vh) translate(0, -50%);
            -o-transform: translate(0, calc(50vh - 50%));
            transform: translate(0, 50vh) translate(0, -50%);
        }
    </style>
    <link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
@endsection

@section('content')
    @if ($user->id_perfil === 0)
        @include('default.perfil.cliente')
    @elseif($user->id_perfil === 1)
        @include('default.perfil.artista')
    @endif
@endsection

@section('js')
    <script src="{{ asset('bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()
        })
    </script>
    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
            <script>toastr.info("{{$error}}")</script>
        @endforeach
    @endif
@endsection