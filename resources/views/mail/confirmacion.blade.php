<table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" bgcolor="#F0F0F0">
    <tbody>
        <tr>
            <td class="x_main" align="center" valign="top" bgcolor="#F0F0F0" style="background-color:#F0F0F0; padding-top:20px">
                <table border="0" width="600" cellpadding="0" cellspacing="0" class="x_container" style="max-width:600px; width:600px">
                    <tbody>
                        <tr>
                            <td class="x_content" align="left" style="background-color:#ffffff; border-radius:5px">
                                <div class="x_header" style="padding:30px 10px; border-bottom:1px solid #eee">
                                    <table border="0" cellpadding="0" cellspacing="0" align="center">
                                        <tbody>
                                            <tr>
                                                <td width="80">
                                                    <a href="#" target="_blank" rel="noopener noreferrer" data-auth="NotApplicable">
                                                        <img data-imagetype="External" src="http://conecte.develop-app.com/assets/img/logoConectaWeb.png" border="0" width="64" height="64" alt="Conecte">
                                                    </a>
                                                </td>
                                                <td width="230">
                                                    <div class="x_brand" style="margin-bottom:3px">
                                                        <a href="{{route('index')}}" target="_blank" rel="noopener noreferrer" data-auth="NotApplicable" style="font-family:Helvetica,Arial,sans-serif; font-size:16px; font-weight:600; color:#374550; text-decoration:none">Conecte.com</a>
                                                        <span style="color:#fff; display:none; visibility:hidden"> - </span>
                                                    </div>
                                                    <div class="x_brand" style="font-family: Helvetica, Arial, sans-serif, serif, EmojiFont; font-size: 14px; font-weight: 400; color: rgb(155, 160, 165);">Tu artista cerca de ti</div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="x_content" style="padding: 42px; font-family: Helvetica, Arial, sans-serif, serif, EmojiFont;">
                                    <div class="x_title" style="font-family: Helvetica, Arial, sans-serif, serif, EmojiFont; font-size: 18px; font-weight: 600; color: rgb(55, 69, 80);">
                                        <div style="text-align:center; font-weight:bold; font-size:22px;">BIENVENIDO A LA FAMILIA CONECTE</div>
                                        <div style="font-size: 18;">Gracias {{ $data['name'] }}</div>
                                    <br>
                                    <div class="x_body-text" style="font-family: Helvetica, Arial, sans-serif, serif, EmojiFont; font-size: 14px; line-height: 20px; text-align: left; color: rgb(51, 51, 51);">
                                        {{ $msg->DESCRIPCION }}
                                        <br>
                                        <br>
                                        <br>
                                        <a href="{{route('confirmarCorreo',[$data['email'],$data['confirm_token']])}}"  target="_blank" rel="noopener noreferrer" data-auth="NotApplicable" style="color:#fff; background-color:#3EB1D4; padding:10px 16px; display:inline-block; border-radius:3px; font-weight:bold; text-decoration:none">Confirmar cuenta</a> </div>
                                        <br>
                                        <br>
                                        <br>
                                        <div>
                                            * si recibió este correo electrónico por error, simplemente elimínelo.<br />
                                            No te suscribirás si haces clic en la confirmación.
                                        </div>
                                    </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="x_footer-text" align="center" style="font-family:Helvetica,Arial,sans-serif; font-size:12px; line-height:16px; color:#aaaaaa; padding-left:24px; padding-right:24px">
                                <br>
                                <br> Conecta tu artista favorito, con tu persona favorita.
                                <br>
                                <br>
                                <strong>Copyright © 2019 Develop App S.A.S</strong>
                                <br>
                                <span class="x_address">Barranquilla Atlántico
                                    <br>
                                </span>
                                <br>
                                <br>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
