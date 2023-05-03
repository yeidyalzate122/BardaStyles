
let strCedula = document.querySelector("#txtCedula").value;


var tableCitasCliente;

document.addEventListener("DOMContentLoaded", function () {
  tableCitasCliente = $("#tableCitasCliente").dataTable({
    aProcessing: true,
    aServerSide: true,
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
    },
    ajax: {
      url: " " + base_url + "/CitasCliente/getCitasCliente/" + strCedula,
      dataSrc: "",
    },
    columns: [
      { data: "idcita" },
      { data: "numero_documento_cliente" },
      { data: "nombreCli" },
      { data: "apellidoCli" },
      { data: "fecha" },
      { data: "descripcion" },
      { data: "total_servicio" },
      { data: "estado" },
      { data: "nombreEm" },
      { data: "apellidoEm" },
      { data: "options" },
    ],
    resonsieve: "true",
    bDestroy: true,
    iDisplayLength: 4,
    order: [[0, "desc"]],
  });

  
  if (document.querySelector("#formCitaCliente")) {
    var tableCitasCliente = document.querySelector("#formCitaCliente");
    tableCitasCliente.onsubmit = function (e) {
      e.preventDefault();

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
      var ajaxUrl = base_url + "/CitasCliente/setCita";
      var formData = new FormData(tableCitasCliente);
      request.open("POST", ajaxUrl, true);
      request.send(formData);

      request.onreadystatechange = function () {
        if (request.readyState == 4 ) {
          var objData = JSON.parse(request.responseText);
          if (objData) {
            $("#modalFormCitaCliente").modal("hide");
            tableCitasCliente.reset();
            swal("Cita", objData.msg, "success");
           
            tableCitasCliente.api().ajax.reload(function () {
             // window.location.reload();
 
            });
          } else {
            swal("Error", objData.msg, "error");
          }
        }
      };
    };
  }


});

window.addEventListener(
  "load",
  function () {
   
    fntServicios();
    fntEmpleado();
  //  fntEstado();
    fntHora();
    fntidCli(strCedula);
    
  },
  false
);

function openModal() {
  
  document
    .querySelector(".modal-header")
    .classList.replace("headerUpdate", "headerRegister");
  document
    .querySelector("#btnActionForm")
    .classList.replace("btn-info", "btn-primary");
  document.querySelector("#btnText").innerHTML = "Guardar";
  document.querySelector("#titleModal").innerHTML = "Nueva Cita";
  document.querySelector("#formCitaCliente").reset();
  $("#modalFormCitaCliente").modal("show");
}



function fntidCli(strCedula) {
  var id=strCedula
  var ajaxUrl = base_url + "/CitasCliente/getSelectIdCliente/"+ id;
  var request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  request.open("GET", ajaxUrl, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      document.querySelector("#clienteid").innerHTML = request.responseText;
      document.querySelector("#clienteid").value = 1;
      $("#clienteid").selectpicker("render");
    }
  };
}


function fntEmpleado() {
  var ajaxUrl = base_url + "/CitasCliente/getSelectEmpleado";
  var request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  request.open("GET", ajaxUrl, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      document.querySelector("#listEmpleado").innerHTML = request.responseText;
      document.querySelector("#listEmpleado").value = 1;
      $("#listEmpleado").selectpicker("render");
    }
  };
}

function fntServicios() {
  var ajaxUrl = base_url + "/CitasCliente/getSelectServicios";
  var request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  request.open("GET", ajaxUrl, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      document.querySelector("#listServicio").innerHTML = request.responseText;
      document.querySelector("#listServicio").value = 1;
      $("#listServicio").selectpicker("render");
    }
  };
}
/*
function fntEstado() {
  var ajaxUrl = base_url + "/CitasCliente/getSelectEstado";
  var request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  request.open("GET", ajaxUrl, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      document.querySelector("#listEstado").innerHTML = request.responseText;
      document.querySelector("#listEstado").value = 1;
      $("#listEstado").selectpicker("render");
    }
  };
}
*/
function fntHora() {
  var ajaxUrl = base_url + "/CitasCliente/getSelectHora";
  var request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  request.open("GET", ajaxUrl, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      document.querySelector("#listHora").innerHTML = request.responseText;
      document.querySelector("#listHora").value = 1;
      $("#listHora").selectpicker("render");
    }
  };
}


function cambioCheckBox(element, precio) {
  // console.log(precio)
   cajatexto = document.querySelector("#txtTotal");
    
   
   if (element.checked) {
      cajatexto.value = parseInt(cajatexto.value) + precio;
   } else {
     cajatexto.value = parseInt(cajatexto.value) - precio;
   }
 
 
 }
 
 function fntViewInfo(idCita) {


  var idcita = idCita;

  var request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");

  var ajaxUser = base_url + "/CitasCliente/getCita/" + idcita;
  request.open("GET", ajaxUser, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var objData = JSON.parse(request.responseText);

      if (objData.status) {
        document.querySelector("#celId").innerHTML = objData.data.idcita;
        document.querySelector("#celDocumetoCli").innerHTML = objData.data.numero_documento_cliente;
        document.querySelector("#celNombreCli").innerHTML = objData.data.nombreCli;
        document.querySelector("#celApellidoUnoCli").innerHTML = objData.data.apellidoCli;
        document.querySelector("#celApellidoDosCli").innerHTML = objData.data.nombre;
        document.querySelector("#celEstado").innerHTML = objData.data.apellidoCliDos;
        document.querySelector("#celNombre").innerHTML = objData.data.nombreEm;
        document.querySelector("#celApellidoUno").innerHTML = objData.data.apellidoEm;
        document.querySelector("#celEstado").innerHTML = objData.data.estado;
        document.querySelector("#celServicios").innerHTML = objData.data.nombre;
        


        $("#modalViewCitasCliente").modal("show");
      } else {
        swal("Error", objData.msg, "error");
      }
    }
  };


}

function fntDelInfoClicita(idcategoria){
  swal({
      title: "Eliminar cita",
      text: "¿Realmente quiere eliminar la cita?",
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
          let ajaxUrl = base_url+'/CitasCliente/delCita';
          let strData = "idcita="+idcategoria;
          request.open("POST",ajaxUrl,true);
          request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          request.send(strData);
          request.onreadystatechange = function(){
              if(request.readyState == 4 && request.status == 200){
                  let objData = JSON.parse(request.responseText);
                  if(objData.status)
                  {
                      swal("Eliminar!", objData.msg , "success");
                      tableCitasCliente.api().ajax.reload();
                  }else{
                      swal("Atención!", objData.msg , "error");
                  }
              }
          }
      }

  });

}


