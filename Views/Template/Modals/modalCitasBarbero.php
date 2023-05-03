<!-- Modal Modificar-->
<div class="modal fade" id="modalFormAcItaBar" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Actualizar cita</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="tile">
          <div class="tile-body">

            <form id="formCitaBarbero" name="formCitaBarbero" class="form-horizontal">
              <input type="hidden" id="idCita" name="idCita" value="">

              <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</p>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label class="control-label" for="txtNombre">Cedula del cliente<span class="required">*</span></label>
                  <input class="form-control valid validText " id="txtCedula" name="txtCedula" type="number" placeholder="Escribe el nombre" minlength="5" maxlength="25" required="" disabled value="">
                </div>
                <div class="form-group col-md-6">
                  <label class="control-label" for="txtFecha">Fecha de la cita<span class="required">*</span></label>
                  <input class="form-control valid validText"disabled id="txtFecha" name="txtFecha" type="date" minlength="5" maxlength="25" placeholder="Escribe el primer apellido" required="">
                </div>

              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label class="control-label" for="listHoraE">Hora<span class="required">*</span></label>

                  <input class="form-control valid validText "disabled id="listHoraE" name="listHoraE" type="text" placeholder="Escribe el nombre" minlength="5" maxlength="25" required="" value="">
             
                </div>

                <div class="form-group col-md-6">
                  <label class="control-label" for="listEmpleado">Empleado<span class="required">*</span></label>
                  <input class="form-control valid validText " id="listEmpleado" name="listEmpleado" type="text" placeholder="Escribe el nombre" minlength="5" maxlength="25" required=""  disabled value="">
             

                </div>

                <div class="form-group col-md-6">
                  <label class="control-label" for="NombreCli">Nombre del cliente<span class="required">*</span></label>
                  <input class="form-control valid validText " id="NombreCli" name="NombreCli" type="text" placeholder="Escribe el nombre" minlength="5" maxlength="25" required=""  disabled value="">
                  
                  <label class="control-label" for="apellidoCli">Apellido del cliente<span class="required">*</span></label>
                  <input class="form-control valid validText " id="apellidoCli" name="apellidoCli" type="text" placeholder="Escribe el nombre" minlength="5" maxlength="25" required=""  disabled value="">
             

                </div>
                <div class="form-group col-md-6">
                  <label class="control-label" for="listServicio">Servicios<span class="required">*</span></label>
                  <input class="form-control valid validText " id="listServicio" name="listServicio" type="text" placeholder="Escribe el nombre" minlength="5" maxlength="25" required="" disabled value="">
             

                  <label class="control-label" for="txtTotal">Total del servicio<span class="required">*</span></label>
                    <input class="form-control valid  " id="txtTotal" name="txtTotal" type="number" value="0"  disabled required="">
                </div>

                <div class="form-group col-md-6">
                  <label for="listEstadoE">Estado de la cita<span class="required">*</span></label>
                  <select class="form-control" id="listEstadoE" name="listEstadoE" required="">
 
                    </select>

                  <label class="control-label" for="listConfirmar">Asistío a la cita <span class="required">*</span></label>
                  <select class="form-control" data-live-search="true" id="listConfirmar" name="listConfirmar" required="">
                   
                   
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
  </div>
</div>