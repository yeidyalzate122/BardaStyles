<!-- Modal -->
<div class="modal fade" id="modalFormPerfil" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header headerUpdate">
        <h5 class="modal-title" id="titleModal">Actualizar Datos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form id="formPerfil" name="formPerfil" class="form-horizontal">
              <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</p>
             
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="txtNombre">Nombres <span class="required">*</span></label>
                  <input type="text" class="form-control valid validText" id="txtNombre" name="txtNombre" value="<?= $_SESSION['userData']['nombre']; ?>" required="">
                </div>
                <div class="form-group col-md-6">
                  <label for="txtApellido">Primer apellido <span class="required">*</span></label>
                  <input type="text" class="form-control valid validText" id="txtApellido" name="txtApellido" value="<?= $_SESSION['userData']['apellido_uno']; ?>" required="">
                </div>
                <div class="form-group col-md-6">
                  <label for="txtApellido">Segundo apellido <span class="required">*</span></label>
                  <input type="text" class="form-control valid validText" id="txtApellidoDos" name="txtApellidoDos" value="<?= $_SESSION['userData']['apellido_dos']; ?>" required="">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="txtTelefono">Teléfono <span class="required">*</span></label>
                  <input type="text" class="form-control valid validNumber" id="txtTelefono" name="txtTelefono" value="<?= $_SESSION['userData']['telefono']; ?>" required="" >
                </div>
                <div class="form-group col-md-6">
                  <label for="txtEmail">Email</label>
                  <input type="email" class="form-control valid validEmail" id="txtEmail" name="txtEmail" value="<?= $_SESSION['userData']['correo']; ?>" required=""  >
                </div>
              </div>
             <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="txtPassword">Contraseña</label>
                  <input type="password" class="form-control" id="txtPassword" name="txtPassword" >
                </div>
                <div class="form-group col-md-6">
                  <label for="txtPasswordConfirm">Confirmar Contraseña</label>
                  <input type="password" class="form-control" id="txtPasswordConfirm" name="txtPasswordConfirm" >
                </div>
             </div>
              <div class="tile-footer">
                <button id="btnActionForm" class="btn btn-info" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Actualizar</span></button>&nbsp;&nbsp;&nbsp;
                <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
              </div>
            </form>
      </div>
    </div>
  </div>
</div>