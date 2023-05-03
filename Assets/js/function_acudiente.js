let tableClientes;

let divLoading = document.querySelector("#divLoading");
document.addEventListener(
  "DOMContentLoaded",
  function () {
    tableClientes = $("#tableAcudientes").dataTable({
      aProcessing: true,
      aServerSide: true,
      language: {
        url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
      },
      ajax: {
        url: " " + base_url + "/Acudiente/getAcudientes",
        dataSrc: "",
      },
      columns: [
        { data: "idacudiente" },
        { data: "nombre" },
        { data: "apellido_uno" },
        { data: "apellido_dos" },
        { data: "telefono" },
        { data: "correo" },
        { data: "parentesco" },
        { data: "options" }
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
      iDisplayLength: 5,
      order: [[0, "desc"]],
    });

    if (document.querySelector("#formAcudiente")) {
      let formCliente = document.querySelector("#formAcudiente");
      formCliente.onsubmit = function (e) {
        e.preventDefault();


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

        let request = window.XMLHttpRequest
          ? new XMLHttpRequest()
          : new ActiveXObject("Microsoft.XMLHTTP");
        let ajaxUrl = base_url + "/Acudiente/setAcudienteM";
        let formData = new FormData(formCliente);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function () {
          if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
          
              $("#modalFormAcudiente").modal("hide");
              formCliente.reset();
              swal("Usuarios", objData.msg, "success");
              tableClientes.api().ajax.reload();
            } else {
              swal("Error", objData.msg, "error");
            }
          }

          return false;
        };
      };
    }
  },
  false
);



window.addEventListener(
  "load",
  function () {
    fntParentescoM();
  },
  false
);



function fntParentescoM() {
  var ajaxUrl = base_url + "/Acudiente/getSelectParentesco";
  var request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  request.open("GET", ajaxUrl, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      document.querySelector("#listParentesco").innerHTML = request.responseText;
      document.querySelector("#listParentesco").value = 1;
      $("#listParentesco").selectpicker("render");
    }
  };
}

function ftnEditAcudiente(idAcudiente) {

  document.querySelector("#titleModal").innerHTML = "Actualizar Rol";
  document
    .querySelector(".modal-header")
    .classList.replace("headerRegister", "headerUpdate");
  document
    .querySelector("#btnActionForm")
    .classList.replace("btn-primary", "btn-info");
  document.querySelector("#btnText").innerHTML = "Actualizar";

  var idcudiente = idAcudiente;
  var request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  var ajaxUrl = base_url + "/Acudiente/getAcudiente/" + idcudiente;
  request.open("GET", ajaxUrl, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var objData = JSON.parse(request.responseText);

      if (objData.status) {
        document.querySelector("#listParentesco").value =
          objData.data.idparentesco;
          document.querySelector("#idacudiente").value =
          objData.data.idacudiente;
        document.querySelector("#idnumero").value =
          objData.data.idacudiente;
        document.querySelector("#txtNombre").value =
          objData.data.nombre;
        document.querySelector("#txtPrimerApellido").value = objData.data.apellido_uno;
        document.querySelector("#txtSegundoApellido").value =
          objData.data.apellido_dos;
        document.querySelector("#txtTelefono").value =
          objData.data.telefono;
        document.querySelector("#txtCorreo").value =
          objData.data.correo;
        
     

        //txtTipoA
        //listRolidA
     
        $("#listParentesco").selectpicker("render");
      }
    }
        $("#modalFormAcudiente").modal("show");
  }

}

