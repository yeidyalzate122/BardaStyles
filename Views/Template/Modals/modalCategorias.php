<!-- Modal guardar-->
<div class="modal fade" id="modalFormCategorias" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nueva Categoría</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formCategoria" name="formCategoria" class="form-horizontal">
          <input type="hidden" id="idTipoServicio" name="idTipoServicio" value="">

          <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</p>

          <div class="col-md">
            <div class="form-group">
              <label class="control-label">Nombre <span class="required">*</span></label>
              <input class="form-control  valid validText " id="txtNombre" name="txtNombre" type="text" placeholder="Nombre Categoría" required="">
            </div>
            <div class="form-group">
              <label class="control-label">Descripción <span class="required">*</span></label>
              <textarea class="form-control  valid validText " id="txtDescripcion" name="txtDescripcion" rows="2" placeholder="Descripción Categoría" required=""></textarea>
            </div>
            <div class="form-group">
              <label for="exampleSelect1">Estado <span class="required">*</span></label>
              <select class="form-control selectpicker" id="listStatus" name="listStatus" required="">
                <option value="1">Activo</option>
                <option value="2">Inactivo</option>
              </select>
            </div>
          </div>



          <div class="tile-footer">
            <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
            <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal vista -->
<div class="modal fade" id="modalViewCategoria" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal">Datos de la categoría</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td>ID:</td>
              <td id="celId"></td>
            </tr>
            <tr>
              <td>Nombres:</td>
              <td id="celNombre"></td>
            </tr>
            <tr>
              <td>Descripción:</td>
              <td id="celDescripcion"></td>
            </tr>
            <tr>
              <td>Estado:</td>
              <td id="celEstado"></td>
            </tr>
            <tr>

          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal modificar categoria -->

<div class="modal fade" id="modalFormCategoriasModificar" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header headerUpdate">
        <h5 class="modal-title" id="titleModal">Modificar Categoría</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formCategoriaM" name="formCategoriaM" class="form-horizontal">
          <input type="hidden" id="idTipoServicioM" name="idTipoServicioM" value="">

          <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</p>

          <div class="col-md">
            <div class="form-group">
              <label class="control-label">Nombre <span class="required">*</span></label>
              <input class="form-control  valid validText " id="txtNombreM" name="txtNombreM" type="text" placeholder="Nombre Categoría" required="">
            </div>
            <div class="form-group">
              <label class="control-label">Descripción <span class="required">*</span></label>
              <textarea class="form-control  valid validText " id="txtDescripcionM" name="txtDescripcionM" rows="2" placeholder="Descripción Categoría" required=""></textarea>
            </div>
            <div class="form-group">
              <label for="exampleSelect1">Estado <span class="required">*</span></label>
              <select class="form-control selectpicker" id="listStatusM" name="listStatusM" required="">
                <option value="1">Activo</option>
                <option value="2">Inactivo</option>
              </select>
            </div>
          </div>



          <div class="tile-footer">
            <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
            <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

