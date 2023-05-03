<!-- Modal -->
<div class="modal fade" id="modalFormProductos" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formProductos" name="formProductos" class="form-horizontal">
          <input type="hidden" id="idProducto" name="idProducto" value="">
          <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</p>
          <div class="row">
            <div class="col-md-8">
              <div class="form-group">
                <label class="control-label">Nombre del producto <span class="required">*</span></label>
                <input class="form-control valid validText " id="txtNombre" name="txtNombre" type="text" placeholder="Escribe el nombre del producto" required="">
              </div>
              <div class="form-group">
                <label class="control-label">Descripción del producto</label>
                <textarea class="form-control" id="txtDescripcion" name="txtDescripcion" placeholder="Describe el producto"></textarea>
              </div>

            </div>
            <div class="col-md-8">
              <div class="form-group">
                <label class="control-label">Código <span class="required">*</span></label>
                <input class="form-control  validNumber" id="txtCodigo" name="txtCodigo" type="text" required="" disabled>
                <br>

              </div>
              <div class="row">

                <div class="form-group col-md-6">
                  <label class="control-label">Cantidad <span class="required">*</span></label>
                  <input class="form-control valid validNumber" id="txtCantidad" name="txtCantidad" type="text" required="">
                </div>

                <div class="form-group col-md-6">
                  <label for="listCategoria">Categoría(tipo producto)<span class="required">*</span></label>
                  <select class="form-control" data-live-search="true" id="listCategoria" name="listCategoria" required=""></select>
                  </select>
                </div>

              </div>
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="listMarca">Marca <span class="required">*</span></label>
                  <select class="form-control" data-live-search="true" id="listMarca" name="listMarca" required=""></select>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="listProveedor">Proveedor <span class="required">*</span></label>
                  <select class="form-control " data-live-search="true" id="listProveedor" name="listProveedor" required="">

                  </select>
                </div>
              </div>
              <div class="row">

                <div class="form-group col-md-6">
                  <label class="control-label">Medida <span class="required">*</span></label>
                  <input class="form-control valid validNumber" id="txtMedida" name="txtMedida" type="text" required="">
                </div>

                <div class="form-group col-md-6">
                  <label for="listMedida">Unidad de medida <span class="required">*</span></label>
                  <select class="form-control" data-live-search="true" id="listMedida" name="listMedida" required=""></select>
                  </select>

                </div>


              </div>

              <div class="row">

                <div class="form-group col-md-6">
                  <label for="listClasificacion">Clasificación <span class="required">*</span></label>
                  <select class="form-control " id="listClasificacion" name="listClasificacion" required="">
                    <option value="2">Producto</option>
                  </select>
                </div>

                <div class="form-group col-md-6">
                  <label for="listStatus">Estado <span class="required">*</span></label>
                  <select class="form-control selectpicker" id="listStatus" name="listStatus" required="">
                    <option value="1">Buen estado</option>
                    <option value="2">Mal estado</option>
                  </select>
                </div>

              </div>

            </div>


            
              <div class="form-group col-md-6">
                <button id="btnActionForm" class="btn btn-primary btn-lg btn-block" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>
              </div>
              <div class="form-group col-md-6">
                <button class="btn btn-danger btn-lg btn-block" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
              </div>
              
          
          </div>
      </div>


      </form>
    </div>
  </div>
</div>
</div>

<!-- Modal vista -->
<div class="modal fade" id="modalViewProducto" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal">Datos del Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td>Codigo:</td>
              <td id="celCodigo"></td>
            </tr>
            <tr>
              <td>Nombres:</td>
              <td id="celNombre"></td>
            </tr>
            <tr>
              <td>Precio:</td>
              <td id="celPrecio"></td>
            </tr>
            <tr>
              <td>Stock:</td>
              <td id="celStock"></td>
            </tr>
            <tr>
              <td>Categoría:</td>
              <td id="celCategoria"></td>
            </tr>
            <tr>
              <td>Status:</td>
              <td id="celStatus"></td>
            </tr>
            <tr>
              <td>Descripción:</td>
              <td id="celDescripcion"></td>
            </tr>
            <tr>
              <td>Fotos de referencia:</td>
              <td id="celFotos">
              </td>
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