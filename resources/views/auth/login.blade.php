<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Asistente Movistar</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="icon" href="{{asset('img/menu/icono.png')}}" type="image/png">
    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body id="body-login">
    <div class="container-fluid" id="login-navbar">
      <div class="d-none d-sm-block">
          <div class="row">
            <div class="col-sm-4">
              <img src="{{asset('img/login/logo.png')}}" id="logo">
            </div>
            <div class="col-sm-8">
              <h1 id="title">Bienvenido a <span>&nbsp;Asistente Movistar</span></h1>
            </div>
          </div>
      </div>

      <div class="d-block d-sm-none">
          <div class="row">
            <div class="col-sm-4">
              <img src="{{asset('img/login/logo.png')}}" id="logo">
            </div>
            <div class="col-sm-8">
              <h1 id="title-mobile">Bienvenido a <span>&nbsp;Asistente Movistar</span></h1>
            </div>
          </div>
      </div>
      <div class="row justify-content-md-center">
          <div class="col-sm-10 col-lg-4">
            <div class="card top-card">
              <h5 class="card-header text-center"><p class="mb-2" id="link-ventas">Fuerza de Ventas</p><p class="m-0" id="link-embajador">Embajador</p></h5>
              <div class="card-body" id="form-ventas">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/experto/login') }}">
                    {{ csrf_field() }}
                    @if(session()->has('error'))
                        <div class="form-group">
                            <div class="col-md-12">
                                <span class="help-block">
                                    <strong>{{ session('error') }}</strong>
                                </span>
                            </div>
                        </div>
                    @endif

                    <div class="form-group{{ $errors->has('user') ? ' has-user' : '' }}">
                        <div class="col-md-12">
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><img src="{{asset('img/login/ID_Punto_Venta.png')}}" height="21"></span>
                              </div>
                              <input id="punto_venta" type="number" class="form-control" name="id_pdv" placeholder="ID Punto de Venta / DI Distribuidor" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="col-md-12">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><img src="{{asset('img/login/E-mail.png')}}" width="21"></span>
                              </div>
                              <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="col-md-12">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><img src="{{asset('img/login/Contrasena.png')}}" height="21"></span>
                              </div>
                              <input id="password" type="password" class="form-control l-padding" name="password" placeholder="Contraseña">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 col-md-offset-6">
                            <button type="submit" class="btn float-right" id="sigin">
                             Ingresar
                            </button>

                            <!-- <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a> -->
                        </div>
                    </div>
                </form>
              </div>
              <div class="card-body display-none" id="form-embajador">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/embajador/login') }}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="col-md-12">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><img src="{{asset('img/login/E-mail.png')}}" width="21"></span>
                              </div>
                              <input id="embajador" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="col-md-12">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><img src="{{asset('img/login/Contrasena.png')}}" height="21"></span>
                              </div>
                              <input id="mrt" type="text" class="form-control l-padding" name="password" placeholder="MRT / MRN">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 col-md-offset-6">
                            <button type="submit" class="btn float-right" id="sigin">
                                Ingresar
                            </button>

                            <!-- <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a> -->
                        </div>
                    </div>
                </form>
              </div>
              <div class="col-md-12">
                  <div class="float-right">
                      <p class="font-blue" id="recover">Registrar / Recordar Contraseña</p>
                  </div>
              </div>
            </div>
          </div>
      </div>
    </div>


    <!-- JavaScripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script type="text/javascript">
        /* elements */

        var linkVentas = $('#link-ventas');
        var formVentas = $('#form-ventas');
        var linkEmbajador = $('#link-embajador');
        var formEmbajador = $('#form-embajador');

        linkVentas.click( function () {
            formEmbajador.hide();
            formVentas.show();
        })

        linkEmbajador.click( function () {
            formEmbajador.show();
            formVentas.hide();
        })
    </script>
</body>
</html>
