@extends('emails.layout')

@section('body')
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:109px;">
        <tr>
            <td align="center">
                <table border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr>
                        <td align="center" valign="middle" class="logo-icon" style="padding-right:24px;">
                            <img src="{{ asset('assets/candado.png') }}" alt="Candado" style="display:block" />
                        </td>
                        <td align="center" valign="middle">
                            <span style="font-weight:900; font-size:37px; color:#92001F; font-family: Geist, sans-serif;">
                                ¿OLVIDÓ SU CONTRASEÑA?
                            </span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center">
                <table border="0" cellspacing="0" cellpadding="0" class="container"
                    style="max-width:600px; width:100%; margin:32px auto;">
                    <tr>
                        <td align="center" class="body-text"
                            style="font-size:22px; line-height:150%; color:#000000; font-weight:400; text-align:center; font-family: Geist, sans-serif;">
                            <p style="margin:0 0 20px 0;">
                                Hola {{ $user->name ?? 'Admin' }},<br>
                                ¡Se ha solicitado cambiar tu contraseña!
                            </p>
                            <p style="margin:0;">
                                Si no has realizado esta solicitud, ignora este correo electrónico. De lo contrario, haz
                                clic en el botón de abajo para cambiar tu contraseña:
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="btn-cta" style="margin-bottom:92px;">
        <tr>
            <td align="center">
                <a href="{{ $user->reset_url ?? '#' }}" style="display:inline-block; max-width:437px; width:100%; height:83px; line-height:83px;
                            background:#FFFFFF; border:1px solid #92001F; border-radius:30px;
                            text-decoration:none; font-weight:900; font-size:21px; color:#92001F;
                            text-align:center; font-family: Geist, sans-serif;">
                    RESTABLECER CONTRASEÑA
                </a>
            </td>
        </tr>
    </table>
@endsection
