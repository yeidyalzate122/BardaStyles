<?php 
    headerAdmin($data); 

    getModal('modalAgendar',$data);
?>

<div id="contentAjax"></div> 
    <main class="app-content">
      <div class="app-title">
        <div>
        <div>
            <h1><i class="fas fa-user-tag"></i> <?= $data['page_title'] ?>
            <?php if($_SESSION['permisosMod']['w']){?>
                <button class="btn btn-primary" type="button" onclick="openModal();" ><i class="fas fa-plus-circle"></i> Nueva cita</button>
                <?php } ?>
              </h1>
        </div>
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
            <table class="table table-hover table-bordered" id="tableCitas">
              <thead>
                <tr>
                  <th>Código </th>
               
                  <th>Número de identidad del cliente</th>
                  <th>Nombre </th>
                  <th>Apellido</th>
                  <th>Fecha</th>
                  <th>Hora</th>
                  <th>Estado</th>
                  <th>Total servicio</th>
                  <th>Nombre del empleado </th>   
                  <th>Apellido del empleado </th>
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

<?php footerAdmin($data); ?>
    