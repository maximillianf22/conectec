<div class="container-fluid">
    <nav class="navbar navbar-light navbar-expand-md fixed-top">
        <div class="container-fluid">
            <a href="#" class="navbar-brand">
                <img src="{{ asset('assets/images/logo.png') }}" />
            </a>
            <button data-toggle="collapse" data-target="#navcol-1" class="navbar-toggler">
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-lg-flex justify-content-lg-end"
                id="navcol-1">
                <ul class="nav navbar-nav">
                    <li class="nav-item d-flex align-items-center">
                        <a class="nav-link" href="#">Destacados</a>
                    </li>
                    <li class="nav-item d-flex align-items-center">
                        <a class="nav-link" href="#">Artistas</a>
                    </li>
                    <li class="nav-item d-flex align-items-center">
                        <a class="nav-link" href="#">Dedicatorias</a>
                    </li>
                    <li class="nav-item d-flex align-items-center">
                        <a class="nav-link border-right-1" href="#">Contratar</a>
                    </li>
                    @if(Auth::user())
                        <li class="nav-item d-flex align-items-center">
                            <a href="#" class="nav-link">
                                <img src="{{ asset('assets/images/sebastian-yatra-artista-colombiano.jpg') }}" height="40" class="rounded-circle pr-2" />{{Auth::user()->name}}
                            </a>
                        </li>
                    @else
                        <li class="nav-item d-flex align-items-center">
                            <a href="/login" class="nav-link">
                                Login
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</div>
