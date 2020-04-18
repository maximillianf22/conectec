<div class="pull-right hidden-xs css-5" onclick="window.location='/welcome'" style="cursor: pointer">
    @lang('conecte.connect')
</div>
<div style="display: flex;">
    <img src="{{ asset('assets/img/logoConecta.png') }}" alt="Conecte.com">
    <div class="css-4">@lang('conecte.connect_by_only') {{ $precio->DESCRIPCION }}</div>
</div>
