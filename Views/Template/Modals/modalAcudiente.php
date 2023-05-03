<!-- Modal -->
<div class="modal fade" id="modalFormAcudiente" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Rol</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="tile">
            <div class="tile-body">
              <form id="formAcudiente" name="formAcudiente">

              <input id="idacudiente" name="idacudiente"   type="hidden"   required="">
              <div class="form-group">
              <div class="form-group">
                    <label for="listParentesco">Parentesco</label>
                    <select class="form-control" id="listParentesco" name="listParentesco" required="">
 
                    </select>
                </div>
              <label class="control-label">Número de documento</label>
                <input class="form-control valid validNumber" id="idnumero" name="idnumero"   type="integer"   required="">
                </div>
                <div class="form-group">
                  <label class="control-label">Nombre</label>
                  <input class="form-control valid validText" id="txtNombre" name="txtNombre" type="text"  required="">
                </div>
                <div class="form-group">
                  <label class="control-label">Primer apellido</label>
                  <input class="form-control valid validText" id="txtPrimerApellido" name="txtPrimerApellido" type="text"  required="">
                </div>
                <div class="form-group">
                  <label class="control-label">Segundo apellido</label>
                  <input class="form-control valid validText" id="txtSegundoApellido" name="txtSegundoApellido" type="text"  required="">
                </div>
                <div class="form-group">
                  <label class="control-label">Teléfono</label>
                  <input class="form-control valid validNumber" id="txtTelefono" name="txtTelefono" type="text"  required="">
                </div>
                <div class="form-group">
                  <label class="control-label">Correo</label>
                  <input class="form-control valid validEmail" id="txtCorreo" name="txtCorreo" type="text"  required="">
                </div>
    
                <div class="tile-footer">
                  <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#" data-dismiss="modal" ><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                </div>
              </form>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
