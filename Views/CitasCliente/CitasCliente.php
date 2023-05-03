<?php 
    headerAdmin($data); 

    getModal('modalCitaCliente',$data);
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

          <input class="form-control valid validText " id="txtCedula" name="txtCedula" type="hidden"  placeholder="Escribe el nombre" minlength="5" maxlength="25" required="" value="<?= $_SESSION['userData']['numero_documento_cliente']; ?>">

            <table class="table table-hover table-bordered" id="tableCitasCliente">
              <thead>
                <tr>
                          
                <th>Codigo de la cita </th>
                  <th>Número de identidad del cliente</th>
                  <th>Nombre </th>
                  <th>Apellido</th>
                  <th>Fecha</th>
                  <th>Hora</th>
                  <th>Total servicio</th>
                  <th>Estado</th>
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
    