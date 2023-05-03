//formulario historial

document.addEventListener(
  "DOMContentLoaded",
  function () {
    var formHistorial = document.querySelector("#formHistorialE");

    formHistorial.onsubmit = function (e) {
      e.preventDefault();
      //estudio
      var strEmpleado = document.querySelector("#listEmpleado").value;
      var strTitulacion = document.querySelector("#txtTitulacion").value;
      var strInstitucion = document.querySelector("#txInstitucion").value;
      var strTiempo = document.querySelector("#txtTiempo").value;
      // var strCertificacion = document.querySelector("#txtCertificacion").value; // no se ha realizado
      var strTipo = document.querySelector("#txtTipo").value;

      //experiencia aboral
      var strNombreEmpresa = document.querySelector("#txtNombreEmpresa").value;
      var strFechaInicio = document.querySelector("#txtFechaInicio").value;
      var strFechaFinal = document.querySelector("#txtFechaFinal").value;
      var strDescripcion = document.querySelector("#txtDescripcion").value;

      if (
        strEmpleado == "" ||
        strTitulacion == "" ||
        strInstitucion == "" ||
        strTiempo == "" ||
        strTipo == "" ||
        strNombreEmpresa == "" ||
        strFechaInicio == "" ||
        strFechaFinal == "" ||
        strDescripcion == ""
      ) {
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

      var request = window.XMLHttpRequest
        ? new XMLHttpRequest()
        : new ActiveXObject("Microsoft.XMLHTTP");
      var ajaxUrl = base_url + "/Empleados/setEmpleadoHistorial";
      var formData = new FormData(formHistorial);
      request.open("POST", ajaxUrl, true);
      request.send(formData);

      request.onreadystatechange = function () {
        if (request.status == 200) {
          var objData = JSON.parse(request.responseText);
          if (objData.status) {
            $("#modalFormHistorialE").modal("hide");
            formEmpleado.reset();
            swal("Empleado", objData.msg, "success");
            tableEmpleados.api().ajax.reload(function (){
        
            });
          } else {
            swal("Error", objData.msg, "error");
          }
        }
      };
    };
  },
  false
);

window.addEventListener(
  "load",
  function () {
   
    fntTipoEstudio();
    fntTipoEstudioA();
   //  fntEstado();
  },
  false
);

function fntTipoEstudio() {
  var ajaxUrl = base_url + "/Empleados/getSelectTipoEstudio";
  var request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  request.open("GET", ajaxUrl, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      document.querySelector("#txtTipo").innerHTML = request.responseText;
      document.querySelector("#txtTipo").value = 1;
      $("#txtTipo").selectpicker("render");
    }
  };
}

function fntTipoEstudioA() {
  var ajaxUrl = base_url + "/Empleados/getSelectTipoEstudio";
  var request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  request.open("GET", ajaxUrl, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      document.querySelector("#txtTipoA").innerHTML = request.responseText;
      document.querySelector("#txtTipoA").value = 1;
      $("#txtTipoA").selectpicker("render");
    }
  };
}



// function fntEstado() {
//   var ajaxUrl = base_url + "/Empleados/getSelectEstado";
//   var request = window.XMLHttpRequest
//     ? new XMLHttpRequest()
//     : new ActiveXObject("Microsoft.XMLHTTP");
//   request.open("GET", ajaxUrl, true);
//   request.send();

//   request.onreadystatechange = function () {
//     if (request.readyState == 4 && request.status == 200) {
//       document.querySelector("#listCer").innerHTML = request.responseText;
//       document.querySelector("#listCer").value = 1;
//       $("#listCer").selectpicker("render");
//     }
//   };
// }


function openModalH() {
  document.querySelector("#idEmpleado").value = "";
  document
    .querySelector(".modal-header")
    .classList.replace("headerUpdate", "headerRegister");
  document
    .querySelector("#btnActionForm")
    .classList.replace("btn-info", "btn-primary");
  document.querySelector("#btnText").innerHTML = "Guardar";
  document.querySelector("#titleModal").innerHTML = "Nuevo Historial Empleado";
  document.querySelector("#formHistorialE").reset();
  $("#modalFormHistorialE").modal("show");
}
