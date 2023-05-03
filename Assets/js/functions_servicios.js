let tableServicio;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");

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

//falta colocar el valid
window.addEventListener(
  "load",
  function () {
    tableServicio = $("#tableServicios").dataTable({
      aProcessing: true,
      aServerSide: true,
      language: {
        url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
      },
      ajax: {
        url: " " + base_url + "/Servicios/getServicios",
        dataSrc: "",
      },
      columns: [
        { data: "idproducto" },
        { data: "nombre" },
        { data: "precio" },
        { data: "tipoSer" },
        { data: "status" },
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

    if (document.querySelector("#formServicios")) {
      let formServicios = document.querySelector("#formServicios");
      formServicios.onsubmit = function (e) {
        e.preventDefault();
        let strNombre = document.querySelector("#txtNombre").value;
        let intCodigo = document.querySelector("#txtCodigo").value;
        let strPrecio = document.querySelector("#txtPrecio").value;
        let strDuracion = document.querySelector("#txtDuracion").value;
        let strCategoria = document.querySelector("#listCategoria").value;

        let strMarca = document.querySelector("#listMarca").value;
        let strClasificacion =
          document.querySelector("#listClasificacion").value;
        let intStatus = document.querySelector("#listStatus").value;

        if (
          strNombre == "" ||
          strPrecio == "" ||
          strDuracion == "" ||
          strCategoria == "" ||
          strDuracion == "" ||
          strMarca == "" ||
          strClasificacion == ""
        ) {
          swal("Atención", "Todos los campos son obligatorios.", "error");
          return false;
        }

        let elementsValid = document.getElementsByClassName("valid");
        for (let i = 0; i < elementsValid.length; i++) {
          if (elementsValid[i].classList.contains("is-invalid")) {
            swal(
              "Atención",
              "Por favor verifique los campos en rojo.",
              "error"
            );
            return false;
          }
        }
        //  divLoading.style.display = "flex";
        tinyMCE.triggerSave();

        let request = window.XMLHttpRequest
          ? new XMLHttpRequest()
          : new ActiveXObject("Microsoft.XMLHTTP");
        let ajaxUrl = base_url + "/Servicios/setServicios";
        let formData = new FormData(formServicios);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function () {
          if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
            
              swal("", objData.msg, "success");
              setTimeout(function () {
              
                window.location.reload();
              }, 2000);


              tableServicio.api().ajax.reload();
              document.querySelector("#idProducto").value = objData.idproducto;
              //  document.querySelector("#containerGallery").classList.remove("notblock");*/
            } else {
              swal("Error", objData.msg, "error");
            }
            console.log(request.responseText);
          }
          divLoading.style.display = "none";
          return false;
        };
      };
    }

    if (document.querySelector(".btnAddImage")) {
      let btnAddImage = document.querySelector(".btnAddImage");
      btnAddImage.onclick = function (e) {
        let key = Date.now();
        let newElement = document.createElement("div");
        newElement.id = "div" + key;
        newElement.innerHTML = `
                 <div class="prevImage"></div>
                 <input type="file" name="foto" id="img${key}" class="inputUploadfile">
                 <label for="img${key}" class="btnUploadfile"><i class="fas fa-upload "></i></label>
                 <button class="btnDeleteImage" type="button" onclick="fntDelItem('#div${key}')"><i class="fas fa-trash-alt"></i></button>`;
        document.querySelector("#containerImages").appendChild(newElement);
        document.querySelector("#div" + key + " .btnUploadfile").click();
        fntInputFile();
      };
    }
    fntInputFile();
    fntCategorias();
    fntMarca();
    //  fntClasificacion();
  },
  false
);

function fntDelInfo(idProducto) {
  swal(
    {
      title: "Eliminar Producto",
      text: "¿Realmente quiere eliminar el producto?",
      type: "warning",
      showCancelButton: true,
      confirmButtonText: "Si, eliminar!",
      cancelButtonText: "No, cancelar!",
      closeOnConfirm: false,
      closeOnCancel: true,
    },
    function (isConfirm) {
      if (isConfirm) {
        let request = window.XMLHttpRequest
          ? new XMLHttpRequest()
          : new ActiveXObject("Microsoft.XMLHTTP");
        let ajaxUrl = base_url + "/Servicios/delProducto";
        let strData = "idProducto=" + idProducto;
        request.open("POST", ajaxUrl, true);
        request.setRequestHeader(
          "Content-type",
          "application/x-www-form-urlencoded"
        );
        request.send(strData);
        request.onreadystatechange = function () {
          if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
              swal("Eliminar!", objData.msg, "success");

              tableServicio.api().ajax.reload();
            } else {
              swal("Atención!", objData.msg, "error");
            }
          }
        };
      }
    }
  );
}

function fntInputFile() {
  let inputUploadfile = document.querySelectorAll(".inputUploadfile");
  inputUploadfile.forEach(function (inputUploadfile) {
    inputUploadfile.addEventListener("change", function () {
      let idProducto = document.querySelector("#idProducto").value;
      let parentId = this.parentNode.getAttribute("id");
      let idFile = this.getAttribute("id");
      let uploadFoto = document.querySelector("#" + idFile).value;
      let fileimg = document.querySelector("#" + idFile).files;
      let prevImg = document.querySelector("#" + parentId + " .prevImage");
      let nav = window.URL || window.webkitURL;

      if (uploadFoto != "") {
        let type = fileimg[0].type;
        let name = fileimg[0].name;
        if (
          type != "image/jpeg" &&
          type != "image/jpg" &&
          type != "image/png"
        ) {
          prevImg.innerHTML = "Archivo no válido";
          uploadFoto.value = "";
          return false;
        } else {
          let objeto_url = nav.createObjectURL(this.files[0]);
          prevImg.innerHTML = `<img class="loading" src="${base_url}/Assets/images/loading.svg" >`;

          let request = window.XMLHttpRequest
            ? new XMLHttpRequest()
            : new ActiveXObject("Microsoft.XMLHTTP");
          let ajaxUrl = base_url + "/Servicios/setImage";
          let formData = new FormData();
          formData.append("idproducto", idProducto);
          formData.append("foto", this.files[0]);
          request.open("POST", ajaxUrl, true);
          request.send(formData);
          request.onreadystatechange = function () {
            if (request.readyState != 4) return;
            if (request.status == 200) {
              let objData = JSON.parse(request.responseText);
              if (objData.status) {
                prevImg.innerHTML = `<img src="${objeto_url}">`;
                document
                  .querySelector("#" + parentId + " .btnDeleteImage")
                  .setAttribute("imgname", objData.imgname);
                document
                  .querySelector("#" + parentId + " .btnUploadfile")
                  .classList.add("notblock");
                document
                  .querySelector("#" + parentId + " .btnDeleteImage")
                  .classList.remove("notblock");
              } else {
                swal("Error", objData.msg, "error");
              }
            }
          };
        }
      }
    });
  });
}
function fntDelItem(element) {
  let nameImg = document
    .querySelector(element + " .btnDeleteImage")
    .getAttribute("imgname");
  let idProducto = document.querySelector("#idProducto").value;
  let request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  let ajaxUrl = base_url + "/Servicios/delFile";

  let formData = new FormData();
  formData.append("idproducto", idProducto);
  formData.append("file", nameImg);
  request.open("POST", ajaxUrl, true);
  request.send(formData);
  request.onreadystatechange = function () {
    if (request.readyState != 4) return;
    if (request.status == 200) {
      let objData = JSON.parse(request.responseText);
      if (objData.status) {
        let itemRemove = document.querySelector(element);
        itemRemove.parentNode.removeChild(itemRemove);
      } else {
        swal("", objData.msg, "error");
      }
    }
  };
}

function fntEditInfo(element, idProducto) {
  rowTable = element.parentNode.parentNode.parentNode;
  document.querySelector("#titleModal").innerHTML = "Actualizar Servicio";
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
  let ajaxUrl = base_url + "/Servicios/getProducto/" + idProducto;
  request.open("GET", ajaxUrl, true);
  request.send();
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      let objData = JSON.parse(request.responseText);
      if (objData.status) {
        let htmlImage = "";
        let objProducto = objData.data;
        document.querySelector("#idProducto").value = objProducto.idproducto;
        document.querySelector("#txtNombre").value = objProducto.nombre;
        document.querySelector("#txtDescripcion").value =
          objProducto.descripcion;
        document.querySelector("#txtCodigo").value = objProducto.idproducto;
        document.querySelector("#txtPrecio").value = objProducto.precio;
        document.querySelector("#txtDuracion").value =
          objProducto.duracion_servicio;
        document.querySelector("#listCategoria").value =
          objProducto.idtiposervicio;
        document.querySelector("#listStatus").value = objProducto.status;
        document.querySelector("#listMarca").value = objProducto.idmarca;
        tinymce.activeEditor.setContent(objProducto.descripcion);

        $("#listMarca").selectpicker("render");
        $("#listCategoria").selectpicker("render");
        $("#listStatus").selectpicker("render");

        if (objProducto.images.length > 0) {
          let objProductos = objProducto.images;
          for (let p = 0; p < objProductos.length; p++) {
            let key = Date.now() + p;
            htmlImage += `<div id="div${key}">
                          <div class="prevImage">
                          <img src="${objProductos[p].url_image}"></img>
                          </div>
                          <button type="button" class="btnDeleteImage" onclick="fntDelItem('#div${key}')" imgname="${objProductos[p].img}">
                          <i class="fas fa-trash-alt"></i></button></div>`;
          }
        }
        document.querySelector("#containerImages").innerHTML = htmlImage;

        document
          .querySelector("#containerGallery")
          .classList.remove("notblock");
        $("#modalFormServicios").modal("show");
      } else {
        swal("Error", objData.msg, "error");
      }
    }
  };
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
  document.querySelector("#titleModal").innerHTML = " Nuevo Servicio";
  document.querySelector("#formServicios").reset();

  $("#modalFormServicios").modal("show");
}
