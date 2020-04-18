<section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree">
        <li>
            <a href="/welcome" class="{{ empty($welcome) ? '' : 'active' }}">
                <i class="fa fa-home f-3"></i> <span>@lang('conecte.home')</span>
            </a>
        </li>
        @if(Auth::user())
            <li>
                <a href="/perfil" class="{{ empty($miPerfil) ? '' : 'active' }}">
                    <i class="fa fa-user"></i> <span>Administrar Perfil</span>
                </a>
            </li>
            <li>
                <a href="/mi-historial" class="{{ empty($miHistorial) ? '' : 'active' }}">
                    <i class="fa fa-history"></i> <span>Historial de solicitudes</span>
                </a>
            </li>
            <li>
                <a href="/mis-pendientes" class="{{ empty($misPendientes) ? '' : 'active' }}">
                    <i class="fa fa-clock-o"></i> <span>Solicitudes Pendientes</span>
                </a>
            </li>
            <li>
                <a href="/mis-movimientos" class="{{ empty($misMovimientos) ? '' : 'active' }}">
                    <i class="fa fa-database"></i> <span>Mis Transacciones</span>
                </a>
            </li>

        @else
            <li>
                <a href="/login">
                    <i class="fa fa-user f-3"></i> <span> @lang('conecte.login')</span>
                </a>
            </li>
        @endif
    </ul>
</section>