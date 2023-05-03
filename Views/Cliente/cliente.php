<?php
headerAdmin($data); ?>
<main class="app-content">

<?php
getModal('modalClienes', $data);

?>

         <?//php dep( $_SESSION['permisosMod']); ?>


  <div class="app-title">
    <div>
      <h1><i class="fas fa-user-tag"></i> <?= $data['page_title'] ?>

      <?php if($_SESSION['permisosMod']['w']){?>
        <button class="btn btn-primary" type="button" onclick="openModal();"><i class="fas fa-plus-circle"></i> Nuevo Cliente</button>

          <?php } ?>

      </h1>



    </div>






    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="<?= base_url(); ?>/roles"><?= $data['page_title'] ?></a></li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <div class="table-responsive">
            <table class="table table-hover table-bordered" id="tableClientes">
              <thead>
                <tr>
                  <th>Código </th>
                  <th>Número de documento</th>
                  <th>Tipo de documento</th>
                  <th>Nombre</th>
                  <th>Primer apellido</th>
                  <th>Seguno apellido</th>
                  <th>Teléfono</th>
                  <th>Fecha de nacimeinto</th>
                  <th>Correo</th>
                  <th>Perfil</th>
                  <th>Número de documento del acudiente</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

</main>
<?php footerAdmin($data); ?>