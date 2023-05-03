<?php
getModal('modalClienes', $data);

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="yeidy">
  <meta name="theme-color" content="#009688">
  <link rel="shortcut icon" href="<?= media(); ?>/images/favicon.ico">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/main.css">
  <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/style.css">

  <title><?= $data['page_tag']; ?></title>
</head>

<body class="bg-dark">

  <section class="material">
    <div class="cover"></div>
  </section>
  <section class="login-content ">
    <div class="logo">
      <h1><?= $data['page_title']; ?></h1>
      <center>
        <div> <button class="btn btn-primary" type="button" onclick="openModal();"><i class="fas fa-plus-circle">  Soy un nuevo cliente</i></button>
        </div>
      </center>

    </div>

    <div class="login-box">
      <div id="divLoading">
        <div>

        </div>
      </div>

      <form class="login-form" name="formLoginClie" id="formLoginClie" action="">


        <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>INICIAR SESIÓN CLIENTE</h3>
        <div class="form-group">
          <label class="control-label">NÚMERO DE IDENTIDAD</label>
          <input id="txtIdentidadClie" name="txtIdentidadClie" class="form-control" type="number" placeholder="ejem: cedula, tarjeta de identidad" autofocus>
        </div>
        <div class="form-group">
          <label class="control-label">CONTRASEÑA</label>
          <input id="txtPasswordClie" name="txtPasswordClie" class="form-control" type="Password" placeholder="Contraseña">
        </div>
        <div class="form-group">
          <div class="utility">
            <p class="semibold-text mb-2"><a href="#" data-toggle="flip">¿Olvidaste tu contraseña?</a></p>
          </div>
        </div>
        <div id="alertLogin" class="text-center"></div>
        <div class="form-group btn-container">
          <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-sign-in-alt"></i> INICIAR SESIÓN</button>
        </div>
      </form>


      <form id="formRecetPass" name="formRecetPass" class="forget-form" action="">
        <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>¿Olvidaste contraseña?</h3>
        <div class="form-group">
          <label class="control-label">CORREO</label>
          <input id="txtEmailResetC" name="txtEmailResetC" class="form-control" type="email" placeholder="CORREO">
        </div>
        <div class="form-group btn-container">
          <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>REINICIAR</button>
        </div>
        <div class="form-group mt-3">
          <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Iniciar sesión</a></p>
        </div>
      </form>


    </div>
  </section>
  <script>
    const base_url = "<?= base_url(); ?>";
  </script>
  <!-- Essential javascripts for application to work-->
  <script src="<?= media(); ?>/js/jquery-3.3.1.min.js"></script>
  <script src="<?= media(); ?>/js/popper.min.js"></script>
  <script src="<?= media(); ?>/js/bootstrap.min.js"></script>
  <script src="<?= media(); ?>/js/fontawesome.js"></script>
  <script src="<?= media(); ?>/js/main.js"></script>
  <!-- The javascript plugin to display page loading on top-->
  <script src="<?= media(); ?>/js/plugins/pace.min.js"></script>
  <script type="text/javascript" src="<?= media(); ?>/js/plugins/sweetalert.min.js"></script>
  <script src="<?= media(); ?>/js/<?= $data['page_functions_js']; ?>"></script>
</body>

</html>