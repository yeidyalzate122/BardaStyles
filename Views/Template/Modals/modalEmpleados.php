<!-- Modal registro -->
<div class="modal fade" id="modalFormEmpleado" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo Empleado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tile">
                    <div class="tile-body">
                        <form id="formEmpleado" name="formEmpleado" class="form-horizontal">
                            <input type="hidden" id="idEmpleado" name="idEmpleado" value="">

                            <p>Todos los campos son obligatorios.</p>
                            <input class="form-control" type="hidden" id="txtStatus" name="txtStatus" type="text" value="1">

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="control-label " for="txtIdentificacion">Identificacion</label>
                                    <input class="form-control valid validNumber" id="txtIdentificacion" name="txtIdentificacion" type="text" placeholder="Número de Identificacion" required="" onkeypress="  return controlTag(event);  ">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="listTipo">Tipo de documento</label>
                                    <select class="form-control" data-live-search="true" id="listTipo" name="listTipo" required="">

                                    </select>
                                </div>
                            </div>



                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtNombre">Nombre</label>
                                    <input class="form-control valid validText " id="txtNombre" name="txtNombre" type="text" placeholder="Escribe el nombre" required="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtPrimerApellido">Primer apellido</label>
                                    <input class="form-control valid validText" id="txtPrimerApellido" name="txtPrimerApellido" type="text" placeholder="Escribe el primer apellido" required="">
                                </div>

                            </div>



                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtSegundoApellido">Segundo apellido</label>
                                    <input class="form-control valid validText" id="txtSegundoApellido" name="txtSegundoApellido" type="text" placeholder="Escribe el segundo apellido" required="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtTelefono">Teléfono</label>
                                    <input class="form-control valid validNumber" id="txtTelefono" name="txtTelefono" type="integer" placeholder="Número de teléfono" required="" onkeypress="  return controlTag(event);  ">
                                </div>

                            </div>



                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtFecha">Fecha de nacimiento</label>
                                    <input class="form-control" id="txtFecha" name="txtFecha" type="date" placeholder="Número de Identificacion" required="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtCorreo">Correo</label>
                                    <input class="form-control valid validEmail" id="txtCorreo" name="txtCorreo" type="text" placeholder="Escribe el correo" required="">
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtContrasena">Contraseña</label>
                                    <input class="form-control" id="txtContrasena" name="txtContrasena" type="text" placeholder="Escribe la contraseña" required="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="listEps">EPS</label>
                                    <select class="form-control" data-live-search="true" id="listEps" name="listEps" required="">

                                    </select>
                                </div>


                            </div>


                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <label for="listRolid">Tipo de cargo</label>
                                    <select class="form-control" data-live-search="true" id="listRolid" name="listRolid" required="">

                                    </select>
                                </div>


                                <div class="form-group col-md-6">
                                    <label class="control-label" for="listCer">Certificado de bioseguridad</label>
                                    <select class="form-control" data-live-search="true" id="listCer" name="listCer" required="">
                                        
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                    </select>
                                </div>


                            </div>





                            <div class="form-row">


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




<!-- Modal lista de datos -->
<div class="modal fade" id="modalViewEmpleado" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header header-primary">
                <h5 class="modal-title" id="titleModal">Datos del Empleado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tile">
                    <div class="tile-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>codigo</td>
                                    <td id="celCodigo"></td>

                                </tr>

                                <tr>
                                    <td>tipo documento</td>
                                    <td id="celTipoDocumento"></td>

                                </tr>
                                <tr>
                                    <td>Identificacion</td>
                                    <td id="celIdentificacion"></td>

                                </tr>


                                <tr>
                                    <td>nombre</td>
                                    <td id="celNombre"></td>

                                </tr>
                                <tr>
                                    <td>Primer Apellido</td>
                                    <td id="celPrimerApellido"></td>

                                </tr>
                                <tr>
                                    <td>Segundo Apellido</td>
                                    <td id="celSegundoApellido"></td>

                                </tr>
                                <tr>
                                    <td>Telefono</td>
                                    <td id="celTelefono"></td>

                                </tr>
                                <tr>
                                    <td>Fecha de nacimiento: (año-mes-dia)</td>
                                    <td id="celFecha"></td>

                                </tr>
                                <tr>
                                    <td>Correo</td>
                                    <td id="celCorreo"></td>

                                </tr>
                                <tr>
                                    <td>Eps</td>
                                    <td id="celEps"></td>

                                </tr>

                                <tr>
                                    <td>Rol</td>
                                    <td id="celRol"></td>

                                </tr>

                                <tr>
                                    <td>Certificado de bioceguridad</td>
                                    <td id="celCertificadoBio"></td>

                                </tr>


                                <tr>
                                    <td>¿Tiene certificado de algun estudio?</td>
                                    <td id="celCertificadoEstudio"></td>

                                </tr>
                                <tr>
                                    <td>Titulacion</td>
                                    <td id="celTitulacion"></td>

                                </tr>
                                <tr>
                                    <td>Institucion</td>
                                    <td id="celInstitucion"></td>

                                </tr>
                                <tr>
                                    <td>Tiempo de estudio</td>
                                    <td id="celTiempo"></td>

                                </tr>
                                <tr>
                                    <td>Tipo estudio</td>
                                    <td id="celTipoEstudio"></td>

                                </tr>
                                <tr>
                                    <td>Nombre Empresa</td>
                                    <td id="celNombreEmpresa"></td>

                                </tr>
                                <tr>
                                    <td>Fecha Inicio: (año-mes-dia)</td>
                                    <td id="celFechaInicio"></td>

                                </tr>
                                <tr>
                                    <td>Fecha Final: (año-mes-dia)</td>
                                    <td id="celFechaFinal"> </td>

                                </tr>
                                <tr>
                                    <td>Descripcion</td>
                                    <td id="celDescripcion"></td>


                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>



<!-- Modal modificar empleado-->
<div class="modal fade" id="modalFormEmpleadoModificar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-heade header-udate">
                <h5 class="modal-title" id="titleModale">Nuevo Empleado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tile">
                    <div class="tile-body">
                        <form id="formEmpleadoM" name="formEmpleadoM" class="form-horizontal">
                            <input type="hidden" id="idEmpleadoA" name="idEmpleadoA" value="">

                            <p>Todos los campos son obligatorios.</p>
                            <h3 class="tile-title">Datos del empleado</h3>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtIdentificacionA">Identificacion</label>
                                    <input class="form-control valid validNumber" id="txtIdentificacionA" name="txtIdentificacionA" type="text" placeholder="Número de Identificacion" required="" onkeypress="  return controlTag(event);  ">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="listTipoA">Tipo de documento</label>
                                    <select class="form-control" data-live-search="true" id="listTipoA" name="listTipoA" required="">

                                    </select>
                                </div>
                            </div>



                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtNombreA">Nombre</label>
                                    <input class="form-control valid validText" id="txtNombreA" name="txtNombreA" type="text" placeholder="Escribe el nombre" required="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtPrimerApellidoA">Primer apellido</label>
                                    <input class="form-control valid validText" id="txtPrimerApellidoA" name="txtPrimerApellidoA" type="text" placeholder="Escribe el primer apellido" required="">
                                </div>

                            </div>



                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtSegundoApellidoA">Segundo apellido</label>
                                    <input class="form-control valid validText" id="txtSegundoApellidoA" name="txtSegundoApellidoA" type="text" placeholder="Escribe el segundo apellido" required="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtTelefonoA">Teléfono</label>
                                    <input class="form-control valid validNumber" id="txtTelefonoA" name="txtTelefonoA" type="integer" placeholder="Número de teléfono" required="" onkeypress="  return controlTag(event);  ">
                                </div>

                            </div>



                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtFechaA">Fecha de nacimiento</label>
                                    <input class="form-control" id="txtFechaA" name="txtFechaA" type="date" placeholder="Número de Identificacion" required="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtCorreoA">Correo</label>
                                    <input class="form-control valid validEmail" id="txtCorreoA" name="txtCorreoA" type="text" placeholder="Escribe el correo" required="">
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtContrasenaA">Contraseña</label>
                                    <input class="form-control " id="txtContrasenaA" name="txtContrasenaA" type="text" placeholder="Escribe la contraseña">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="listEpsA">EPS</label>
                                    <select class="form-control" data-live-search="true" id="listEpsA" name="listEpsA" required="">

                                    </select>
                                </div>


                            </div>


                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <label for="listRolidA">Tipo de cargo</label>
                                    <select class="form-control" data-live-search="true" id="listRolidA" name="listRolidA" required="">

                                    </select>
                                </div>


                            </div>





                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <label class="control-label" for="listCerA">Certificado de bioseguridad</label>
                                    <select class="form-control" data-live-search="true" id="listCerA" name="listCerA" required="">
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                    </select>
                                </div>

                            </div>

                            <p>Todos los campos son obligatorios. se puede buscar el empleado</p>



                            <h3 class="tile-title">Estudio</h3>
                            <div class="form-row">




                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtTitulacionA">Titulación:</label>
                                    <input class="form-control valid validText" id="txtTitulacionA" name="txtTitulacionA" type="text" placeholder="Escribe el segundo apellido" required="">
                                </div>
                            </div>

                            <div class="form-row">


                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txInstitucionA">Institución:</label>
                                    <input class="form-control valid validText" id="txInstitucionA" name="txInstitucionA" type="text" placeholder="Escribe el segundo apellido" required="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtTiempoA">Tiempo de estudio:</label>
                                    <input class="form-control valid validText" id="txtTiempoA" name="txtTiempoA" type="text" placeholder="Escribe el segundo apellido" required="">
                                </div>
                            </div>


                            <div class="form-row">


                                <div class="form-group col-md-6">
                                    <label class="control-label" for="listCerH">Certificación: </label>
                                    <select class="form-control" data-live-search="true" id="listCerH" name="listCerH" required="">
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtTipoA">Tipo de estudio:</label>

                                    <select class="form-control" data-live-search="true" id="txtTipoA" name="txtTipoA" required="">

                                    </select>


                                </div>
                            </div>


                            <h3 class="tile-title">Experiencia Laboral </h3>


                            <div class="form-row">


                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtNombreEmpresaA">Nombre de la empresa: </label>
                                    <input class="form-control valid validText" id="txtNombreEmpresaA" name="txtNombreEmpresaA" type="text" placeholder="Escribe el segundo apellido" required="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtFechaInicioA">Fecha de inicio:</label>
                                    <input class="form-control" id="txtFechaInicioA" name="txtFechaInicioA" type="date" placeholder="Escribe el segundo apellido" required="">
                                </div>
                            </div>

                            <div class="form-row">


                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtFechaFinalA">Fecha final: </label>
                                    <input class="form-control" id="txtFechaFinalA" name="txtFechaFinalA" type="date" placeholder="Escribe el segundo apellido" required="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtDescripcionA">Descripción:</label>
                                    <textarea class="form-control valid validText" id="txtDescripcionA" name="txtDescripcionA" rows="4" placeholder="Enter your address"></textarea>
                                </div>
                            </div>




                            <div class="tile-footer">
                                <button id="btnActionFormA" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnTextA">Guardar</span></button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>