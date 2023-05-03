let tableCitas;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");
document.addEventListener(
  "DOMContentLoaded",
  function () {
    tableCitas = $("#tableCitas").dataTable({
      aProcessing: true,
      aServerSide: true,
      language: {
        url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
      },
      ajax: {
        url: " " + base_url + "/AgendarCitas/getCitas",
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
      'dom': 'lBfrtip',
      'buttons': [
          {
              "extend": "copyHtml5",
              "text": "<i class='far fa-copy'></i> Copiar",
              "titleAttr":"Copiar",
              "className": "btn btn-secondary"
          },{
              "extend": "excelHtml5",
              "text": "<i class='fas fa-file-excel'></i> Excel",
              "titleAttr":"Esportar a Excel",
              "className": "btn btn-success"
          },{
              "extend": "pdfHtml5",
              "text": "<i class='fas fa-file-pdf'></i> PDF",
              "titleAttr":"Esportar a PDF",
              "className": "btn btn-danger"
          },{
              "extend": "csvHtml5",
              "text": "<i class='fas fa-file-csv'></i> CSV",
              "titleAttr":"Esportar a CSV",
              "className": "btn btn-info"
          }
      ],
      resonsieve: "true",
      bDestroy: true,
      iDisplayLength: 10,
      order: [[0, "desc"]],
    });


    var fechaCI = document.querySelector("#txtFecha").value;

    txtFecha.min = new Date().toISOString().split("T")[0];




    //NUEVA CITA




    if (document.querySelector("#formAgendar")) {
      var formEmpleado = document.querySelector("#formAgendar");
      formEmpleado.onsubmit = function (e) {
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
        var ajaxUrl = base_url + "/AgendarCitas/setCita";
        var formData = new FormData(formEmpleado);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
  
        request.onreadystatechange = function () {
          if (request.readyState == 4 ) {
            var objData = JSON.parse(request.responseText);
            if (objData) {
              $("#modalFormAgendar").modal("hide");
              formEmpleado.reset();
              swal("Cita", objData.msg, "success");
             
              tableCitas.api().ajax.reload(function () {
                window.location.reload();
   
              });
            } else {
              swal("Error", objData.msg, "error");
            }
          }
        };
      };
    }


  },
  false
);

window.addEventListener(
  "load",
  function () {
    fntCliente();
    fntEmpleado();
    
    fntHora();
    fntServicios();
  },
  false
);

function openModal() {
  document.querySelector("#idCita").value = "";
  document
    .querySelector(".modal-header")
    .classList.replace("headerUpdate", "headerRegister");
  document
    .querySelector("#btnActionForm")
    .classList.replace("btn-info", "btn-primary");
  document.querySelector("#btnText").innerHTML = "Guardar";
  document.querySelector("#titleModal").innerHTML = "Nueva Cita";
  document.querySelector("#formAgendar").reset();
  $("#modalFormAgendar").modal("show");
}

function fntCliente() {
  var ajaxUrl = base_url + "/AgendarCitas/getSelectCliente";
  var request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  request.open("GET", ajaxUrl, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      document.querySelector("#listCedula").innerHTML = request.responseText;
      document.querySelector("#listCedula").value = 1;
      $("#listCedula").selectpicker("render");
    }
  };
}

function fntEmpleado() {
  var ajaxUrl = base_url + "/AgendarCitas/getSelectEmpleado";
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

function fntEstado() {
  var ajaxUrl = base_url + "/AgendarCitas/getSelectEstado";
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

function fntServicios() {
  var ajaxUrl = base_url + "/AgendarCitas/getSelectServicios";
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

function fntHora() {
  var ajaxUrl = base_url + "/AgendarCitas/getSelectHora";
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
function fntViewInfoAgen(idCita) {
  var idcita = idCita;

  var request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");

  var ajaxUser = base_url + "/AgendarCitas/getCita/" + idcita;
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
        

        $("#modalViewCitas").modal("show");
      } else {
        swal("Error", objData.msg, "error");
      }
    }
  };
}

function fntDelInfo(idcategoria) {
  swal(
    {
      title: "Eliminar cita",
      text: "¿Realmente quiere eliminar la cita?",
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
        let ajaxUrl = base_url + "/AgendarCitas/delCita";
        let strData = "idcita=" + idcategoria;
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
              tableCitas.api().ajax.reload();
            } else {
              swal("Atención!", objData.msg, "error");
            }
          }
        };
      }
    }
  );
}
