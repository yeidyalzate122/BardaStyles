<!-- Modal -->
<div class="modal fade" id="modalFormHistorialE" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo Historial Empleado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tile">
                    <div class="tile-body">
                        <form id="formHistorialE" name="formHistorialE" class="form-horizontal">
                            <input type="hidden" id="idEmpleado" name="idEmpleado" value="">

                            <p>Todos los campos son obligatorios.</p>



                            <h3 class="tile-title">Estudio</h3>
                            <div class="form-row">



                                <div class="form-group col-md-6">
                                    <label for="listEmpleado">Empleado:</label>
                                    <select class="form-control" data-live-search="true" id="listEmpleado" name="listEmpleado" required="">

                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtTitulacion">Titulación:</label>
                                    <input class="form-control valid validText" id="txtTitulacion" name="txtTitulacion" type="text" placeholder="Escribe el segundo apellido" required="">
                                </div>
                            </div>

                            <div class="form-row">


                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txInstitucion">Institución:</label>
                                    <input class="form-control valid validText" id="txInstitucion" name="txInstitucion" type="text" placeholder="Escribe el segundo apellido" required="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtTiempo">Tiempo de estudio:</label>
                                    <input class="form-control valid validText" id="txtTiempo" name="txtTiempo" type="text" placeholder="Escribe el segundo apellido" required="">
                                </div>
                            </div>


                            <div class="form-row">


                                <div class="form-group col-md-6">
                                    <label class="control-label" for="listCerAA">Certificación: </label>
                                    <select class="form-control" data-live-search="true" id="listCerAA" name="listCerAA" required="">

                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtTipo">Tipo de estudio:</label>

                                    <select class="form-control" data-live-search="true" id="txtTipo" name="txtTipo" required="">

                                    </select>


                                </div>
                            </div>


                            <h3 class="tile-title">Experiencia Laboral </h3>


                            <div class="form-row">


                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtNombreEmpresa">Nombre de la empresa: </label>
                                    <input class="form-control valid validText" id="txtNombreEmpresa" name="txtNombreEmpresa" type="text" placeholder="Escribe el segundo apellido" required="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtFechaInicio">Fecha de inicio:</label>
                                    <input class="form-control valid validText" id="txtFechaInicio" name="txtFechaInicio" type="date" placeholder="Escribe el segundo apellido" required="">
                                </div>
                            </div>

                            <div class="form-row">


                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtFechaFinal">Fecha final: </label>
                                    <input class="form-control" id="txtFechaFinal" name="txtFechaFinal" type="date" placeholder="Escribe el segundo apellido" required="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtDescripcion">Descripción:</label>
                                    <textarea class="form-control valid validText" id="txtDescripcion" name="txtDescripcion" rows="4" placeholder="Enter your address"></textarea>
                                </div>
                            </div>


                            <div class="tile-footer">
                                <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>