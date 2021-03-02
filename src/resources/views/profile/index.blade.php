@extends('layouts.app')
<title>{{ __("editarPerfil") }} | Cyberlabs</title>
<style>
    body {
        background-color: white !important;
    }
</style>
@section('content')
<link rel="stylesheet" href="{{ asset('css/editar-perfil.css') }}">
<div class="wrapper ">

    <div class="content">
        <div class="padding-top">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 padding-right-profile">
                                <div class="row">
                                    <div class="tab-content col-md-12">
                                        <div class="tab-pane active" id="a">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <h2 class="h2-editar-perfil"><i class="fa fa-user primary-color margin-right-8px" style="color: #0047ff;"></i> <strong style="color: black !important;">{{ __("editarPerfilDatosPersonales") }}</strong></h2>
                                                    <br>
                                                </div>
                                                <form class="simple_form form-horizontal" id="form-general" enctype="multipart/form-data" accept-charset="UTF-8" data-remote="true" method="POST" action="editarusuario">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="circle inline-block border green-flat-text" style="float: left; margin-right: 0 !important; margin-left: auto; background-image:url({{ $user->pathAttachment() }});background-size:cover;background-position:center;width:170px;height:170px;margin-top:0;margin-bottom: 0; border: solid 3px currentColor !important;"></div>
                                                        <input type="file" id="myFile" name="picture" style="padding-top: 125px; margin-left: 15px;">
                                                        <div class="col-lg-12">
                                                            <div class="col-lg-6" style="padding-left: 0;">
                                                                <div class="field">
                                                                    <label>{{ __("editarPerfilNombreUsuario") }}</label>
                                                                    <input class="f-input-form-editar-perfil" maxlength="20" size="20" type="text" value="{{$user->name}}{{$user->last_name}}" name="user_username" id="user_username" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABHklEQVQ4EaVTO26DQBD1ohQWaS2lg9JybZ+AK7hNwx2oIoVf4UPQ0Lj1FdKktevIpel8AKNUkDcWMxpgSaIEaTVv3sx7uztiTdu2s/98DywOw3Dued4Who/M2aIx5lZV1aEsy0+qiwHELyi+Ytl0PQ69SxAxkWIA4RMRTdNsKE59juMcuZd6xIAFeZ6fGCdJ8kY4y7KAuTRNGd7jyEBXsdOPE3a0QGPsniOnnYMO67LgSQN9T41F2QGrQRRFCwyzoIF2qyBuKKbcOgPXdVeY9rMWgNsjf9ccYesJhk3f5dYT1HX9gR0LLQR30TnjkUEcx2uIuS4RnI+aj6sJR0AM8AaumPaM/rRehyWhXqbFAA9kh3/8/NvHxAYGAsZ/il8IalkCLBfNVAAAAABJRU5ErkJggg==&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;" readonly>
                                                                </div>
                                                                <br>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="field">
                                                            <label>{{ __("editarPerfilNombre") }}</label>
                                                            <input class="f-input-form-editar-perfil" maxlength="100" size="100" type="text" value="{{$user->name}}" name="user_name" id="user_name">
                                                        </div><br>
                                                        <div class="field">
                                                            <label>{{ __("editarPerfilCorreoElectronico") }}</label>
                                                            <input autofocus="autofocus" class="f-input-form-editar-perfil" type="email" value="{{$user->email}}" name="user_email" id="user_email">
                                                        </div><br>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="field">
                                                            <label>{{ __("editarPerfilApellidos") }}</label>
                                                            <input class="f-input-form-editar-perfil" maxlength="100" size="100" type="text" value="{{$user->last_name}}" name="user_lastname" id="user_lastname">
                                                        </div><br>
                                                        <div class="field">
                                                            <label>{{ __("editarPerfilRol") }}</label>
                                                            <input class="f-input-form-editar-perfil" maxlength="100" size="100" type="text" value="{{$user->role->name}}" name="user_rol" id="user_rol" readonly>
                                                        </div>
                                                    </div>
                                                    <br><br>
                                                    <div class="col-lg-12">
                                                        <div class="field">
                                                            <button type="submit" class="f-main-btn pull-right">{{ __("editarPerfilBotonActualizar") }}</button>
                                                        </div>
                                                        <br>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 padding-right-profile">
                                <div class="row">
                                    <div class="tab-content col-md-12">
                                        <div class="tab-pane active" id="a">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <h2 class="h2-editar-perfil"><i class="fa fa-key primary-color margin-right-8px" style="color: #0047ff;"></i> <strong style="color: black !important;">{{ __("editarPerfilCambiarContraseña") }}</strong></h2>
                                                    <br>
                                                </div>
                                                <form class="simple_form form-horizontal" id="form-general" enctype="multipart/form-data" accept-charset="UTF-8" data-remote="true" method="post" action="editarcontrasena">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="col-lg-6" style="padding-left: 0;">
                                                                <div class="field">
                                                                    <label>{{ __("editarContrasenaActual") }}</label>
                                                                    <input onchange="checkCamposCompletados()" class="f-input-form-editar-perfil" maxlength="20" size="20" type="password" name="contrasenaActual" id="contrasenaActual" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABHklEQVQ4EaVTO26DQBD1ohQWaS2lg9JybZ+AK7hNwx2oIoVf4UPQ0Lj1FdKktevIpel8AKNUkDcWMxpgSaIEaTVv3sx7uztiTdu2s/98DywOw3Dued4Who/M2aIx5lZV1aEsy0+qiwHELyi+Ytl0PQ69SxAxkWIA4RMRTdNsKE59juMcuZd6xIAFeZ6fGCdJ8kY4y7KAuTRNGd7jyEBXsdOPE3a0QGPsniOnnYMO67LgSQN9T41F2QGrQRRFCwyzoIF2qyBuKKbcOgPXdVeY9rMWgNsjf9ccYesJhk3f5dYT1HX9gR0LLQR30TnjkUEcx2uIuS4RnI+aj6sJR0AM8AaumPaM/rRehyWhXqbFAA9kh3/8/NvHxAYGAsZ/il8IalkCLBfNVAAAAABJRU5ErkJggg==&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;">
                                                                </div>
                                                                <br>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="field">
                                                            <label>{{ __("editarNuevaContrasena") }}</label>
                                                            <input onchange="checkCamposCompletados()" class="f-input-form-editar-perfil" maxlength="100" size="100" type="password" name="nuevaContrasena" id="nuevaContrasena">
                                                        </div><br>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="field">
                                                            <label>{{ __("editarPerfilRepiteTuNuevaContrasena") }}</label>
                                                            <input onchange="checkCamposCompletados()" class="f-input-form-editar-perfil" maxlength="100" size="100" type="password" name="repiteTuNuevaContrasena" id="repiteTuNuevaContrasena">
                                                        </div><br>
                                                    </div>
                                                    <br><br>
                                                    <div class="col-lg-12">
                                                        <div class="field">
                                                            <button id="boton-actualizar-contrasena" type="submit" style="margin-bottom: 35px;" class="f-main-btn pull-right">{{ __("editarPerfilBotonCambiarContrasena") }}</button>
                                                        </div>
                                                        <br>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <style type="text/css">
                    .padding-right-profile{
                        padding-right: 4%;
                    }
                </style>
            </div>
        </div>
    </div>
</div>

<script>

    document.getElementById('boton-actualizar-contrasena').disabled = true;

    function checkCamposCompletados() {
        let inputContrasenaActual = document.getElementById('contrasenaActual');
        let inputNuevaContrasena = document.getElementById('nuevaContrasena');
        let inputRepiteTuNuevaContrasena = document.getElementById('repiteTuNuevaContrasena');
        let botonCambiarContrasena = document.getElementById('boton-actualizar-contrasena');

        if (inputContrasenaActual.value != "" && inputRepiteTuNuevaContrasena.value != "" && inputNuevaContrasena.value != "") {
            if (inputNuevaContrasena.value == inputRepiteTuNuevaContrasena.value) {
                botonCambiarContrasena.disabled = false;
            } else {
                botonCambiarContrasena.disabled = true;
            }

        } else {
            botonCambiarContrasena.disabled = true;
        }
    }
</script>
@endsection