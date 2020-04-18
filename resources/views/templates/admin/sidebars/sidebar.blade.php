<section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree">
        <li class="{{ empty($administrador) ? '' : 'active' }}">
            <a href="{{ route('admin') }}">
                <i class="fa fa-home f-3"></i> <span>Inicio</span>
            </a>
        </li>
        <li class="{{ empty($clientes) ? '' : 'active' }}">
            <a href="{{ route('clientes.clientes.index') }}">
                <i class="fa fa-user"></i> <span>Clientes</span>
            </a>
        </li>
        <li class="{{ empty($artistas) ? '' : 'active' }}">
            <a href="{{ route('artistas.artistas.index') }}">
                <i class="fa fa-user"></i> <span>Artistas</span>
            </a>
        </li>

        <li class="{{ empty($dedicatoriasPage) ? '' : 'active' }}">
            <a href="{{ route('dedicatorias.dedicatorias.index') }}" >
                <i class="fa fa-envelope-open"></i> <span>Dedicatorias</span>
            </a>
        </li>

        <li class="{{ empty($contratacionesPage) ? '' : 'active' }}">
            <a href="{{ route('contrataciones.contrataciones.index') }}" >
                <i class="fa fa-file-excel-o"></i> <span>Contrataciones</span>
            </a>
        </li>

        <li class="{{ empty($liquidacionesPage) ? '' : 'active' }}">
            <a href="{{ route('liquidaciones.liquidaciones.index') }}" >
                <i class="fa fa-database"></i> <span>Liquidaciones</span>
            </a>
        </li>

        <li class="{{ empty($movimientosPage) ? '' : 'active' }}">
            <a href="{{ route('movimientos.movimientos.index') }}" >
                <i class="fa fa-database"></i> <span>Movimientos</span>
            </a>
        </li>

        <li class="">
            <a href="{{ route('configuraciones.configuraciones.show', ['id'=>1]) }}" >
                <i class="fa fa-cog"></i> <span>Generos</span>
            </a>
        </li>

        <li class="">
            <a href="{{ route('configuraciones.configuraciones.show', ['id'=>14]) }}" >
                <i class="fa fa-cog"></i> <span>Tipo Celebridad</span>
            </a>
        </li>
        
        <li class="{{ empty($configuracion) ? '' : 'active' }}">
            <a href="{{ route('configuraciones.configuraciones.index') }}" >
                <i class="fa fa-cog"></i> <span>Configuraciones</span>
            </a>
        </li>

       
    </ul>
</section>