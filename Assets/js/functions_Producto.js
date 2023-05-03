let tableProducto;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");

window.addEventListener(
  "load",
  function () {
    tableProducto = $("#tableProductos").dataTable({
      aProcessing: true,
      aServerSide: true,
      language: {
        url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
      },
      ajax: {
        url: " " + base_url + "/Producto/getProductos",
        dataSrc: "",
      },
      columns: [
        { data: "idproducto" },
        { data: "nombre" },
        { data: "cantidad" },
        { data: "tipoSer" },
        { data: "proveedor" },
        { data: "medida" },
        { data: "unidad" },
        { data: "status" },
        { data: "clasificacion" },
        { data: "options" },
      ],
      columnDefs: [
        { className: "textcenter", targets: [3] },
        { className: "textright", targets: [4] },
        { className: "textcenter", targets: [5] },
      ],
      dom: "lBfrtip",
      buttons: [
        {
          extend: "copyHtml5",
          text: "<i class='far fa-copy'></i> Copiar",
          titleAttr: "Copiar",
          className: "btn btn-secondary",
          exportOptions: {
            columns: [0, 1, 2, 3, 4, 5],
          },
        },
        {
          extend: "excelHtml5",
          text: "<i class='fas fa-file-excel'></i> Excel",
          titleAttr: "Esportar a Excel",
          className: "btn btn-success",
          exportOptions: {
            columns: [0, 1, 2, 3, 4, 5],
          },
        },
        {
          extend: "pdfHtml5",
          text: "<i class='fas fa-file-pdf'></i> PDF",
          titleAttr: "Esportar a PDF",
          className: "btn btn-danger",
          exportOptions: {
            columns: [0, 1, 2, 3, 4, 5],
          },
        },
        {
          extend: "csvHtml5",
          text: "<i class='fas fa-file-csv'></i> CSV",
          titleAttr: "Esportar a CSV",
          className: "btn btn-info",
          exportOptions: {
            columns: [0, 1, 2, 3, 4, 5],
          },
        },
      ],
      resonsieve: "true",
      bDestroy: true,
      iDisplayLength: 10,
      order: [[0, "desc"]],
    });

    if (document.querySelector("#formProductos")) {
      let formProductos = document.querySelector("#formProductos");
      formProductos.onsubmit = function (e) {
        e.preventDefault();
        let strNombre = document.querySelector("#txtNombre").value;
        let intCodigo = document.querySelector("#txtCodigo").value;
        let strCantidad = document.querySelector("#txtCantidad").value;
        let strCategoria = document.querySelector("#listCategoria").value;
        let intMarca = document.querySelector("#listMarca").value;
        let intProveedor = document.querySelector("#listProveedor").value;
        let intCantidad = document.querySelector("#txtCantidad").value;
        let intMedida = document.querySelector("#listMedida").value;
        let intClasificacion =
          document.querySelector("#listClasificacion").value;
        let intStatus = document.querySelector("#listStatus").value;

        if (
          strNombre == "" ||
          strCantidad == "" ||
          strCategoria == "" ||
          intMarca == "" ||
          intProveedor == "" ||
          intCantidad == "" ||
          intMedida == "" ||
          intClasificacion == ""
        ) {
          swal("Atención", "Todos los campos son obligatorios.", "error");
          return false;
        }

        //divLoading.style.display = "flex";
        tinyMCE.triggerSave();

        let request = window.XMLHttpRequest
          ? new XMLHttpRequest()
          : new ActiveXObject("Microsoft.XMLHTTP");
        let ajaxUrl = base_url + "/Producto/setProducto";
        let formData = new FormData(formProductos);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function () {
          if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
              swal("", objData.msg, "success");
              window.location.reload();
              formProductos.api().ajax.reload();
              document.querySelector("#idProducto").value = objData.idproducto;
              //  document.querySelector("#containerGallery").classList.remove("notblock");*/
            } else {
              swal("Error", objData.msg, "error");
            }
          }
          divLoading.style.display = "none";
          return false;
        };
      };
    }

    fntCategorias();
    fntMarca();
    // fntClasificacion();
    fntUnidad();
    fntProveedor();
  },
  false
);

$(document).on("focusin", function (e) {
  if ($(e.target).closest(".tox-dialog").length) {
    e.stopImmediatePropagation();
  }
});

tinymce.init({
  selector: "#txtDescripcion",
  plugins:
    "a11ychecker advcode table advlist lists image media anchor link autoresize",
  toolbar:
    "a11ycheck | blocks bold forecolor backcolor | bullist numlist | alignleft aligncenter alignright alignjustify |",
  a11y_advanced_options: true,
  a11ychecker_html_version: "html5",
  a11ychecker_level: "aaa",
  content_style:
    "body { font-family:Helvetica,Arial,sans-serif; font-size:16px }",
});

//modificar

function fntEditInfo(element, idProducto) {
  rowTable = element.parentNode.parentNode.parentNode;
  document.querySelector("#titleModal").innerHTML = "Actualizar Producto";
  document
    .querySelector(".modal-header")
    .classList.replace("headerRegister", "headerUpdate");
  document
    .querySelector("#btnActionForm")
    .classList.replace("btn-primary", "btn-info");
  document.querySelector("#btnText").innerHTML = "Actualizar";
  let request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  let ajaxUrl = base_url + "/Producto/getProducto/" + idProducto;
  request.open("GET", ajaxUrl, true);
  request.send();
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      let objData = JSON.parse(request.responseText);
      if (objData.status) {
        document.querySelector("#idProducto").value = objData.data.idproducto;
        document.querySelector("#txtNombre").value = objData.data.nombre;
        document.querySelector("#txtDescripcion").value = objData.data.descr;
        document.querySelector("#txtCodigo").value = objData.data.idproducto;
        document.querySelector("#txtCantidad").value = objData.data.cantidad;
        document.querySelector("#listCategoria").value =
          objData.data.idtiposervicio;
        document.querySelector("#listMarca").value = objData.data.idmarca;
        document.querySelector("#listProveedor").value =
          objData.data.idproveedor;

        document.querySelector("#txtMedida").value = objData.data.medida;

        document.querySelector("#listMedida").value =
          objData.data.idunidadmedida;

        document.querySelector("#listClasificacion").value =
          objData.data.idclasificacion;

        document.querySelector("#listStatus").value = objData.data.status;

        $("#listCategoria").selectpicker("render");
        $("#listMarca").selectpicker("render");
        $("#listProveedor").selectpicker("render");

        $("#listMedida").selectpicker("render");

        $("#listClasificacion").selectpicker("render");
        $("#listStatus").selectpicker("render");

         tinymce.activeEditor.setContent(objData.data.descripcion);
      } else {
        swal("Error", objData.msg, "error");
      }
      $("#modalFormProductos").modal("show");
    }
  };
}


function fntDelInfo(idcategoria){
  swal({
      title: "Eliminar Producto",
      text: "¿Realmente quiere eliminar el producto?",
      type: "warning",
      showCancelButton: true,
      confirmButtonText: "Si, eliminar!",
      cancelButtonText: "No, cancelar!",
      closeOnConfirm: false,
      closeOnCancel: true
  }, function(isConfirm) {
      
      if (isConfirm) 
      {
          let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
          let ajaxUrl = base_url+'/Producto/delProducto';
          let strData = "idproducto="+idcategoria;
          request.open("POST",ajaxUrl,true);
          request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          request.send(strData);
          request.onreadystatechange = function(){
              if(request.readyState == 4 && request.status == 200){
                  let objData = JSON.parse(request.responseText);
                  if(objData.status)
                  {
                      swal("Eliminar!", objData.msg , "success");
                      tableProducto.api().ajax.reload();
                  }else{
                      swal("Atención!", objData.msg , "error");
                  }
              }
          }
      }

  });

}



function openModal() {
  rowTable = "";
  document.querySelector("#idProducto").value = "";
  document
    .querySelector(".modal-header")
    .classList.replace("headerUpdate", "headerRegister");
  document
    .querySelector("#btnActionForm")
    .classList.replace("btn-info", "btn-primary");
  document.querySelector("#btnText").innerHTML = "Guardar";
  document.querySelector("#titleModal").innerHTML = " Nuevo Producto";
  document.querySelector("#formProductos").reset();
  $("#modalFormProductos").modal("show");
}

function fntCategorias() {
  if (document.querySelector("#listCategoria")) {
    let ajaxUrl = base_url + "/Categorias/getSelectCategorias";
    let request = window.XMLHttpRequest
      ? new XMLHttpRequest()
      : new ActiveXObject("Microsoft.XMLHTTP");
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        document.querySelector("#listCategoria").innerHTML =
          request.responseText;
        $("#listCategoria").selectpicker("render");
      }
    };
  }
}

function fntMarca() {
  if (document.querySelector("#listMarca")) {
    let ajaxUrl = base_url + "/Servicios/getSelectMarca";
    let request = window.XMLHttpRequest
      ? new XMLHttpRequest()
      : new ActiveXObject("Microsoft.XMLHTTP");
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        document.querySelector("#listMarca").innerHTML = request.responseText;
        $("#listMarca").selectpicker("render");
      }
    };
  }
}

function fntClasificacion() {
  if (document.querySelector("#listClasificacion")) {
    let ajaxUrl = base_url + "/Servicios/getSelectClasificacion";
    let request = window.XMLHttpRequest
      ? new XMLHttpRequest()
      : new ActiveXObject("Microsoft.XMLHTTP");
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        document.querySelector("#listClasificacion").innerHTML =
          request.responseText;
        $("#listClasificacion").selectpicker("render");
      }
    };
  }
}

function fntProveedor() {
  if (document.querySelector("#listProveedor")) {
    let ajaxUrl = base_url + "/Servicios/getSelectProveedor";
    let request = window.XMLHttpRequest
      ? new XMLHttpRequest()
      : new ActiveXObject("Microsoft.XMLHTTP");
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        document.querySelector("#listProveedor").innerHTML =
          request.responseText;
        $("#listProveedor").selectpicker("render");
      }
    };
  }
}

function fntUnidad() {
  if (document.querySelector("#listMedida")) {
    let ajaxUrl = base_url + "/Servicios/getSelectUnidad";
    let request = window.XMLHttpRequest
      ? new XMLHttpRequest()
      : new ActiveXObject("Microsoft.XMLHTTP");
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        document.querySelector("#listMedida").innerHTML = request.responseText;
        $("#listMedida").selectpicker("render");
      }
    };
  }
}
