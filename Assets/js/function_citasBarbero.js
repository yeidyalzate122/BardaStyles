var tableCitasBArbero;
//let strCedula = document.querySelector("#txtCedula").value;
let strCedula = document.querySelector("#txtCedulaB").value;

document.addEventListener("DOMContentLoaded", function () {
  tableCitasBArbero = $("#tableCitasBar").dataTable({
    aProcessing: true,
    aServerSide: true,
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
    },
    ajax: {
      url: " " + base_url + "/CitasBarberos/getCitasBarbero/" + strCedula,
      dataSrc: "",
    },
    columns: [
      { data: "idcita" },
      { data: "numero_documento_cliente" },
      { data: "nombreCli" },
      { data: "apellidoCli" },
      { data: "fecha" },
      { data: "descripcion" },
      { data: "estado" },
      { data: "total_servicio" },
      { data: "nombreEm" },
      { data: "apellidoEm" },
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
    iDisplayLength: 4,
    order: [[0, "desc"]],
  });


  if (document.querySelector("#formCitaBarbero")) {
    let formCliente = document.querySelector("#formCitaBarbero");
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
      let ajaxUrl = base_url + "/CitasBarberos/setCitaBarberoM";
      let formData = new FormData(formCliente);
      request.open("POST", ajaxUrl, true);
      request.send(formData);
      request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
          let objData = JSON.parse(request.responseText);
          if (objData.status) {
        
            $("#modalFormAcItaBar").modal("hide");
            formCliente.reset();
            swal("Cita", objData.msg, "success");
            tableCitasBArbero.api().ajax.reload();
          } else {
            swal("Error", objData.msg, "error");
          }
        }

        return false;
      };
    };
  }
});

window.addEventListener(
  "load",
  function () {
    fntEstadoM();
    fntAsistenciaM();
  },
  false
);

function fntEstadoM() {
  var ajaxUrl = base_url + "/CitasBarberos/getSelectEstado";
  var request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  request.open("GET", ajaxUrl, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      document.querySelector("#listEstadoE").innerHTML = request.responseText;
      document.querySelector("#listEstadoE").value = 1;
      $("#listEstadoE").selectpicker("render");
    }
  };
}

function fntAsistenciaM() {
  var ajaxUrl = base_url + "/CitasBarberos/getSelectAsistencia";
  var request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  request.open("GET", ajaxUrl, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      document.querySelector("#listConfirmar").innerHTML = request.responseText;
      document.querySelector("#listConfirmar").value = 1;
      $("#listConfirmar").selectpicker("render");
    }
  };
}



function fntEditInfoBar(idAcudiente) {
  document.querySelector("#titleModal").innerHTML = "Actualizar Cita";
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
  var ajaxUrl = base_url + "/CitasBarberos/getCitaBarbero/" + idcudiente;
  request.open("GET", ajaxUrl, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var objData = JSON.parse(request.responseText);

      if (objData.status) {
        document.querySelector("#idCita").value = objData.data.idcita;
        document.querySelector("#txtCedula").value =
          objData.data.numero_documento_cliente;
        document.querySelector("#txtFecha").value = objData.data.fecha;
        document.querySelector("#listHoraE").value = objData.data.descripcion;
        document.querySelector("#listEmpleado").value = objData.data.nombreEm;
        document.querySelector("#listServicio").value = objData.data.nombre;
        document.querySelector("#txtTotal").value = objData.data.total_servicio;
        document.querySelector("#listEstadoE").value =objData.data.id_estado_cita;
        document.querySelector("#listConfirmar").value =objData.data.idasistencia
        document.querySelector("#NombreCli").value =objData.data.nombreCli;
        document.querySelector("#apellidoCli").value =objData.data.apellidoCli;
       


        $("#listConfirmar").selectpicker("render"); 
        $("#listEstadoE").selectpicker("render");
      }
    }
    $("#modalFormAcItaBar").modal("show");
  };
}
