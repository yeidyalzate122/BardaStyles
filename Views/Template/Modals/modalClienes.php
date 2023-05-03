<!-- Modal registro -->
<div class="modal fade" id="modalFormCliente" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <form id="formCliente" name="formCliente" class="form-horizontal">
                            <input type="hidden" id="idCliente" name="idCliente" value="">

                            <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</p>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="control-label " for="txtIdentificacion">Identificacion<span class="required">*</span></label>
                                    <input class="form-control valid validNumber" id="txtIdentificacion" name="txtIdentificacion" type="number" minlength="5" maxlength="25" placeholder="Número de Identificacion" required="" >
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="listTipo">Tipo de documento<span class="required">*</span></label>
                                    <select class="form-control" data-live-search="true" id="listTipo" name="listTipo" required="">

                                    </select>
                                </div>
                            </div>



                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtNombre">Nombre<span class="required">*</span></label>
                                    <input class="form-control valid validText " id="txtNombre" name="txtNombre" type="text" placeholder="Escribe el nombre" minlength="5" maxlength="25" required="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtPrimerApellido">Primer apellido<span class="required">*</span></label>
                                    <input class="form-control valid validText" id="txtPrimerApellido" name="txtPrimerApellido" type="text" minlength="5" maxlength="25" placeholder="Escribe el primer apellido" required="">
                                </div>

                            </div>



                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtSegundoApellido">Segundo apellido<span class="required">*</span></label>
                                    <input class="form-control valid validText" id="txtSegundoApellido" name="txtSegundoApellido" type="text" minlength="5" maxlength="25" placeholder="Escribe el segundo apellido" required="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtTelefono">Teléfono<span class="required">*</span></label>
                                    <input class="form-control valid validNumber" id="txtTelefono" name="txtTelefono" type="number"minlength="5" maxlength="13" placeholder="Número de teléfono" required="" >
                                </div>

                            </div>



                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtFecha">Fecha de nacimiento<span class="required">*</span></label>
                                    <input class="form-control" id="txtFecha" name="txtFecha" type="date" placeholder="Número de Identificacion" required="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtCorreo">Correo</label>
                                    <input class="form-control  validEmail" id="txtCorreo" name="txtCorreo" minlength="5" maxlength="60" type="text" placeholder="Escribe el correo" required="">
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtContrasena">Contraseña<span class="required">*</span></label>
                                    <input class="form-control" id="txtContrasena" name="txtContrasena" type="text" placeholder="Escribe la contraseña" minlength="5" maxlength="25" required="">
                                </div>


                                <input class="form-control" hidden id="txtStatus" name="txtStatus" type="text" value="1">

                                <input class="form-control" hidden id="listRolid" name="listRolid" type="text" value="4">
                            </div>

                            <div class="tile-footer">

                                <div class="form-row">
                                    <p class="text-primary"><span class="required">En caso de que el cliente sea menor de 14, por favor llenar los sigientes campos de un acudiente responsable</span> </p>
                                    <div class="form-group col-md-6">
                                        <label for="listParentesco">Parentesco</label>
                                        <select class="form-control" data-live-search="true" id="listParentesco" name="listParentesco" required="">

                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="txtNumeroP">Número de identidad</label>
                                        <input class="form-control  validNumber" id="txtNumeroP" name="txtNumeroP"minlength="5" maxlength="13" type="integer">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="txtNombreP">Nombres </label>
                                        <input type="text" class="form-control  validText" id="txtNombreP"minlength="5" maxlength="25" name="txtNombreP" value="">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="txtPrimerApellidoP">Primer apellido</label>
                                        <input type="text" class="form-control  validText" id="txtPrimerApellidoP"minlength="5" maxlength="25" name="txtPrimerApellidoP" value="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="txtSegundoApellidoP">Segundo apellido</label>
                                        <input type="text" class="form-control  validText" id="txtSegundoApellidoP"minlength="5" maxlength="25" name="txtSegundoApellidoP" value="">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="txtTelefonoP">Teléfono</label>
                                        <input class="form-control  validNumber" id="txtTelefonoP" name="txtTelefonoP"minlength="5" maxlength="13" type="integer">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="txtCorreoP">Correo</label>
                                        <input class="form-control validEmail" id="txtCorreoP" name="txtCorreoP"minlength="5" maxlength="60" type="text">
                                    </div>
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

<!-- Modal lista de datos -->
<div class="modal fade" id="modalViewCliente" tabindex="-2" role="dialog" aria-hidden="true">
    <div class="modal-dialog  ">
        <div class="modal-content">
            <div class="modal-header header-primary ">
                <h5 class="modal-title" id="titleModal">Datos del Cliente</h5>
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
                                    <td>Código</td>
                                    <td id="celCodigo"></td>

                                </tr>

                                <tr>
                                    <td>Tipo documento</td>
                                    <td id="celTipoDocumento"></td>

                                </tr>
                                <tr>
                                    <td>Identificacion</td>
                                    <td id="celIdentificacion"></td>

                                </tr>


                                <tr>
                                    <td>Nombre</td>
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
                                    <td>Teléfono</td>
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
                                    <td>Cargo</td>
                                    <td id="celRol"></td>




                                </tr>
                                <tr>
                                    <td>Número de documento  del acudiente</td>
                                    <td id="celacudiente"></td>




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

<!-- Modal modificar cliente -->
<div class="modal fade" id="modalFormClienteModificar" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <form id="formClienteM" name="formClienteM" class="form-horizontal">
                            <input type="hidden" id="idClienteA" name="idClienteA" value="">

                            <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</p>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="control-label " for="txtIdentificacionA">Identificacion<span class="required">*</span></label>
                                    <input class="form-control valid validNumber" id="txtIdentificacionA" name="txtIdentificacionA" type="text" placeholder="Número de Identificacion" required="" onkeypress="  return controlTag(event);  ">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="listTipoA">Tipo de documento<span class="required">*</span></label>
                                    <select class="form-control" data-live-search="true" id="listTipoA" name="listTipoA" required="">

                                    </select>
                                </div>
                            </div>



                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtNombreA">Nombre<span class="required">*</span></label>
                                    <input class="form-control valid validText " id="txtNombreA" name="txtNombreA" type="text" placeholder="Escribe el nombre" required="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtPrimerApellidoA">Primer apellido<span class="required">*</span></label>
                                    <input class="form-control valid validText" id="txtPrimerApellidoA" name="txtPrimerApellidoA" type="text" placeholder="Escribe el primer apellido" required="">
                                </div>

                            </div>



                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtSegundoApellidoA">Segundo apellido<span class="required">*</span></label>
                                    <input class="form-control valid validText" id="txtSegundoApellidoA" name="txtSegundoApellidoA" type="text" placeholder="Escribe el segundo apellido" required="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtTelefonoA">Teléfono<span class="required">*</span></label>
                                    <input class="form-control valid validNumber" id="txtTelefonoA" name="txtTelefonoA" type="integer" placeholder="Número de teléfono" required="" onkeypress="  return controlTag(event);  ">
                                </div>

                            </div>



                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtFechaA">Fecha de nacimiento<span class="required">*</span></label>
                                    <input class="form-control" id="txtFechaA" name="txtFechaA" type="date" placeholder="Número de Identificacion" required="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtCorreoA">Correo</label>
                                    <input class="form-control  validEmail" id="txtCorreoA" name="txtCorreoA" type="text" placeholder="Escribe el correo" required="">
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="txtContrasena">Contraseña<span class="required">*</span></label>
                                    <input class="form-control" id="txtContrasenaA" name="txtContrasenaA" type="text" placeholder="Escribe la contraseña" >
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="control-label" for="idacudienteA">Número de cocumento del acudiente<span class="required">*</span></label>
                                    <input class="form-control valid validNumber" id="idacudienteA" name="idacudienteA" type="integer" disabled placeholder="Número de teléfono" required="" onkeypress="  return controlTag(event);  ">
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

