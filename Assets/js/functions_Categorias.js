let tableCategorias;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");
document.addEventListener(
  "DOMContentLoaded",
  function () {
    tableCategorias = $("#tableCategorias").dataTable({
      aProcessing: true,
      aServerSide: true,
      language: {
        url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
      },
      ajax: {
        url: " " + base_url + "/Categorias/getCategorias",
        dataSrc: "",
      },
      columns: [
        { data: "idtiposervicio" },
        { data: "nombre" },
        { data: "descripcion" },
        { data: "status" },
        { data: "options" },
      ],
      dom: "lBfrtip",
      buttons: [
        {
          extend: "copyHtml5",
          text: "<i class='far fa-copy'></i> Copiar",
          titleAttr: "Copiar",
          className: "btn btn-secondary",
        },
        {
          extend: "excelHtml5",
          text: "<i class='fas fa-file-excel'></i> Excel",
          titleAttr: "Esportar a Excel",
          className: "btn btn-success",
        },
        {
          extend: "pdfHtml5",
          text: "<i class='fas fa-file-pdf'></i> PDF",
          titleAttr: "Esportar a PDF",
          className: "btn btn-danger",
        },
        {
          extend: "csvHtml5",
          text: "<i class='fas fa-file-csv'></i> CSV",
          titleAttr: "Esportar a CSV",
          className: "btn btn-info",
        },
      ],
      resonsieve: "true",
      bDestroy: true,
      iDisplayLength: 10,
      order: [[0, "desc"]],
    });

    //NUEVA CATEGORIA
    if (document.querySelector("#formCategoria")) {
      let formCategoria = document.querySelector("#formCategoria");
      formCategoria.onsubmit = function (e) {
        e.preventDefault();
        let strNombre = document.querySelector("#txtNombre").value;
        let strDescripcion = document.querySelector("#txtDescripcion").value;
        let intStatus = document.querySelector("#listStatus").value;
        if (strNombre == "" || strDescripcion == "" || intStatus == "") {
          swal("Atención", "Todos los campos son obligatorios.", "error");
          return false;
        }

        let elementsValid = document.getElementsByClassName("valid");
        for (let i = 0; i < elementsValid.length; i++) {
          if (elementsValid[i].classList.contains("is-invalid")) {
            swal("Atención", "Por favor verifique los campos en rojo.", "error");
            return false;
          }
        }
        let request = window.XMLHttpRequest
          ? new XMLHttpRequest()
          : new ActiveXObject("Microsoft.XMLHTTP");
        let ajaxUrl = base_url + "/Categorias/setCategoria";
        let formData = new FormData(formCategoria);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function () {
          if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
              if (rowTable == "") {
                tableCategorias.api().ajax.reload();
              } else {
                htmlStatus =
                  intStatus == 1
                    ? '<span class="badge badge-success">Activo</span>'
                    : '<span class="badge badge-danger">Inactivo</span>';
                rowTable.cells[1].textContent = strNombre;
                rowTable.cells[2].textContent = strDescripcion;
                rowTable.cells[3].innerHTML = htmlStatus;
                rowTable = "";
              }

              $("#modalFormCategorias").modal("hide");
              formCategoria.reset();
              swal("Categoria", objData.msg, "success");
            } else {
              swal("Error", objData.msg, "error");
            }
          }
          divLoading.style.display = "none";
          return false;
        };
      };
    }

    //modificar
    if (document.querySelector("#formCategoriaM")) {
      let formCategoria = document.querySelector("#formCategoriaM");
      formCategoria.onsubmit = function (e) {
        e.preventDefault();
        let strNombre = document.querySelector("#txtNombreM").value;
        let strDescripcion = document.querySelector("#txtDescripcionM").value;
        let intStatus = document.querySelector("#listStatusM").value;
        if (strNombre == "" || strDescripcion == "" || intStatus == "") {
          swal("Atención", "Todos los campos son obligatorios.", "error");
          return false;
        }

        let elementsValid = document.getElementsByClassName("valid");
        for (let i = 0; i < elementsValid.length; i++) {
          if (elementsValid[i].classList.contains("is-invalid")) {
            swal("Atención", "Por favor verifique los campos en rojo.", "error");
            return false;
          }
        }
        let request = window.XMLHttpRequest
          ? new XMLHttpRequest()
          : new ActiveXObject("Microsoft.XMLHTTP");
        let ajaxUrl = base_url + "/Categorias/setCategoriaM";
        let formData = new FormData(formCategoria);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function () {
          if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
              /*   if(rowTable == ""){
                        tableCategorias.api().ajax.reload();
                    }else{
                        htmlStatus = intStatus == 1 ? 
                            '<span class="badge badge-success">Activo</span>' : 
                            '<span class="badge badge-danger">Inactivo</span>';
                        rowTable.cells[1].textContent = strNombre;
                        rowTable.cells[2].textContent = strDescripcion;
                        rowTable.cells[3].innerHTML = htmlStatus;
                        rowTable = "";
                    }
*/
              $("#modalFormCategoriasModificar").modal("hide");
              formCategoria.reset();
              swal("Categoria", objData.msg, "success");
              tableCategorias.api().ajax.reload();
            } else {
              swal("Error", objData.msg, "error");
            }
          }
          divLoading.style.display = "none";
          return false;
        };
      };
    }
  },
  false
);


//Lito
function fntViewInfo(idCategoria) {
  var idcategoria = idCategoria;

  var request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");

  var ajaxUser = base_url + "/Categorias/getCategoria/" + idcategoria;
  request.open("GET", ajaxUser, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var objData = JSON.parse(request.responseText);

      if (objData.status) {
        let estado =
          objData.data.status == 1
            ? '<span class="badge badge-success">Activo</span>'
            : '<span class="badge badge-danger">Inactivo</span>';
        document.querySelector("#celId").innerHTML =
          objData.data.idtiposervicio;
        document.querySelector("#celNombre").innerHTML = objData.data.nombre;
        document.querySelector("#celDescripcion").innerHTML =
          objData.data.descripcion;
        document.querySelector("#celEstado").innerHTML = estado;

        $("#modalViewCategoria").modal("show");
      } else {
        swal("Error", objData.msg, "error");
      }
    }
  };
}


function fntEditInfo(element,idcategoria){
  rowTable = element.parentNode.parentNode.parentNode;
  document.querySelector('#titleModal').innerHTML ="Actualizar Categoría";
  document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
  document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
  document.querySelector('#btnText').innerHTML ="Actualizar";


  
  let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
  let ajaxUrl = base_url+'/Categorias/getCategoria/'+idcategoria;
  request.open("GET",ajaxUrl,true);
  request.send();
  request.onreadystatechange = function(){
      if(request.readyState == 4 && request.status == 200){
          let objData = JSON.parse(request.responseText);
          if(objData.status)
          {
              document.querySelector("#idTipoServicioM").value = objData.data.idtiposervicio;
              document.querySelector("#txtNombreM").value = objData.data.nombre;
              document.querySelector("#txtDescripcionM").value = objData.data.descripcion;
             
            

              if(objData.data.status == 1){
                  document.querySelector("#listStatusM").value = 1;
              }else{
                  document.querySelector("#listStatusM").value = 2;
              }
              $('#listStatus').selectpicker('render');



              $('#modalFormCategoriasModificar').modal('show');

          }else{
              swal("Error", objData.msg , "error");
          }
      }
  }
}
function fntDelInfo(idcategoria){
  swal({
      title: "Eliminar Categoría",
      text: "¿Realmente quiere eliminar al categoría?",
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
          let ajaxUrl = base_url+'/Categorias/delCategoria';
          let strData = "idtiposervicio="+idcategoria;
          request.open("POST",ajaxUrl,true);
          request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          request.send(strData);
          request.onreadystatechange = function(){
              if(request.readyState == 4 && request.status == 200){
                  let objData = JSON.parse(request.responseText);
                  if(objData.status)
                  {
                      swal("Eliminar!", objData.msg , "success");
                      tableCategorias.api().ajax.reload();
                  }else{
                      swal("Atención!", objData.msg , "error");
                  }
              }
          }
      }

  });

}

function openModal() {
  document.querySelector("#idTipoServicio").value = "";
  document
    .querySelector(".modal-header")
    .classList.replace("headerUpdate", "headerRegister");
  document
    .querySelector("#btnActionForm")
    .classList.replace("btn-info", "btn-primary");
  document.querySelector("#btnText").innerHTML = "Guardar";
  document.querySelector("#titleModal").innerHTML = "Nueva Categoría";
  document.querySelector("#formCategoria").reset();
  $("#modalFormCategorias").modal("show");
}
