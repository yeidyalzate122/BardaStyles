<?php
headerAdmin($data); ?>
<main class="app-content">

<?php
getModal('modalEmpleados', $data);
getModal('modalHistorialE', $data);

?>

         <?php //dep( $_SESSION['permisosMod']); ?>


  <div class="app-title">
    <div>
      <h1><i class="fas fa-user-tag"></i> <?= $data['page_title'] ?>

      <?php if($_SESSION['permisosMod']['w']){?>
        <button class="btn btn-primary" type="button" onclick="openModal();"><i class="fas fa-plus-circle"></i> Nuevo Empleado</button>

        <button class="btn btn-info" type="button" onclick="openModalH();"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book-half" viewBox="0 0 16 16">
            <path d="M8.5 2.687c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z" />
          </svg> Nuevo Historial</button>
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
            <table class="table table-hover table-bordered" id="tableEpleados">
              <thead>
                <tr>
                  <th>Código </th>
                  <th>Número de documento</th>
                  <th>Tipo de documento</th>
                  <th>Nombre</th>
                  <th>Primer apellido</th>
                  <th>Seguno apellido</th>
                  <th>Telefono</th>
                  <th>Fecha de nacimeinto</th>
                  <th>Correo</th>
                  <th>Eps</th>
                  <th>Cargo</th>                
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