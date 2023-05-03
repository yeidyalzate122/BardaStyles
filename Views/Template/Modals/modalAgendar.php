<!-- Modal guardar-->
<div class="modal fade" id="modalFormAgendar" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nueva Cita</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formAgendar" name="formAgendar" class="form-horizontal">
          <input type="hidden" id="idCita" name="idCita" value="">

          <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</p>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label class="control-label" for="listCedula">Cedula del cliente<span class="required">*</span></label>
              <select class="form-control" data-live-search="true" id="listCedula" name="listCedula" required="">

              </select>
            </div>
            <div class="form-group col-md-6">
              <label class="control-label" for="txtFecha">Fecha de la cita<span class="required">*</span></label>
              <input class="form-control valid validText" id="txtFecha" name="txtFecha" type="date" required="">
            </div>

          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label class="control-label" for="txtHora">Hora<span class="required">*</span></label>
              <select class="form-control" data-live-search="true" id="listHora" name="listHora" required="">
               
              </select>
            </div>

            <div class="form-group col-md-6">
              <label class="control-label" for="listEmpleado">Empleado<span class="required">*</span></label>
              <select class="form-control" data-live-search="true" id="listEmpleado" name="listEmpleado" required="">

              </select>
            </div>
            <div class="form-group col-md-6">
              <label class="control-label" for="txtFecha">Servicios<span class="required">*</span></label>
              <div class="form-check" id="listServicio">

              </div>
            </div>
            <div class="form-group col-md-6">
              <label class="control-label" for="txtFecha">Estado de la cita<span class="required">*</span></label>
              <select class="form-control" data-live-search="true" id="listEstado" name="listEstado" required="" >
              <option value="1">Agendada</option> 
              </select>
            </div>

            <div class="form-group col-md-6">
              <label class="control-label" for="txtTotal">Total del servicio<span class="required">*</span></label>
             
              <input class="form-control valid  " id="txtTotal" name="txtTotal" type="number"  value="0" required="" >
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
<div class="modal fade" id="modalViewCitas" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal">Datos de la cita</h5>
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
              <td>Documento del cliente:</td>
              <td id="celDocumetoCli"></td>
            </tr>
            <tr>
              <td>Nombres:</td>
              <td id="celNombreCli"></td>
            </tr>
            <tr>
              <td>Primer apellido:</td>
              <td id="celApellidoUnoCli"></td>
            </tr>
            <tr>
              <td>Segundo apellido:</td>
              <td id="celApellidoDosCli"></td>
            </tr>
            <tr>
              <td>Nombre del empleado:</td>
              <td id="celNombre"></td>
            </tr>
            <tr>
              <td>Apellido del epleado:</td>
              <td id="celApellidoUno"></td>
            </tr>
           
            <tr>
              <td>Estado:</td>
              <td id="celEstado"></td>
            </tr>
            <tr>
              <td>Servicios:</td>
              <td id="celServicios"></td>
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
          <input type="hidden" id="idCita" name="idCita" value="">

          <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</p>

          <div class="col-md">
            <div class="form-group">
              <label class="control-label">Nombre <span class="required">*</span></label>
              <input class="form-control  valid validText " id="txtTotalM" name="txtTotalM" type="text" placeholder="Nombre Categoría" required="">
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