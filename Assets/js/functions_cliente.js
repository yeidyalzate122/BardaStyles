let tableClientes;

let divLoading = document.querySelector("#divLoading");
document.addEventListener(
  "DOMContentLoaded",
  function () {
    tableClientes = $("#tableClientes").dataTable({
      aProcessing: true,
      aServerSide: true,
      language: {
        url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
      },
      ajax: {
        url: " " + base_url + "/Cliente/getClientes",
        dataSrc: "",
      },
      columns: [
        { data: "idcliente" },
        { data: "numero_documento_cliente" },
        { data: "tipo_documento" },
        { data: "nombre" },
        { data: "apellido_uno" },
        { data: "apellido_dos" },
        { data: "telefono" },
        { data: "fechanacimiento" },
        { data: "correo" },
        { data: "cargo" },
        { data: "idacudiente"},
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
      iDisplayLength: 3,
      order: [[0, "desc"]],
    });

    if (document.querySelector("#formCliente")) {
      let formCliente = document.querySelector("#formCliente");
      formCliente.onsubmit = function (e) {
        e.preventDefault();
        var strIdentificacion =
          document.querySelector("#txtIdentificacion").value;
        var strTipo = document.querySelector("#listTipo").value;
        var strNombre = document.querySelector("#txtNombre").value;
        var strPrimerApellido =
          document.querySelector("#txtPrimerApellido").value;
        var strSegundoApellido = document.querySelector(
          "#txtSegundoApellido"
        ).value;
        var strTelefono = document.querySelector("#txtTelefono").value;
        var strFecha = document.querySelector("#txtFecha").value;
        var strCorreo = document.querySelector("#txtCorreo").value;
        var strContrasena = document.querySelector("#txtContrasena").value;
        var strStatus = document.querySelector("#txtStatus").value;
        var strRolid = document.querySelector("#listRolid").value;

        // valor del acudiente
        var strParentesco = document.querySelector("#listParentesco").value;
        var strNumeroP = document.querySelector("#txtNumeroP").value;
        var strNombreP = document.querySelector("#txtNombreP").value;
        var strPrimerApellidoP = document.querySelector(
          "#txtPrimerApellidoP"
        ).value;
        var strSegundoApellidoP = document.querySelector(
          "#txtSegundoApellidoP"
        ).value;
        var strTelefonoP = document.querySelector("#txtTelefonoP").value;
        var strCorreoP = document.querySelector("#txtCorreoP").value;
        if (
          strIdentificacion == "" ||
          strTipo == "" ||
          strNombre == "" ||
          strPrimerApellido == "" ||
          strSegundoApellido == "" ||
          strTelefono == "" ||
          strFecha == "" ||
          strCorreo == "" ||
          strContrasena == "" 
         
        ) {
          swal("Atención", "Todos los campos son obligatorios.", "error");
          return false;
        }

//validacion de contraseña

var txt_longitud, txt_mayusculas, txt_minusculas, txt_numeros;


        if(strContrasena.length < 5 ){
          swal("Atención", "La contraseña debe tener un mínimo de 5 caracteres." , "info");
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


        

        // Regular expression
    const regexlower = /[a-z]/;

    // Check if string contians numbers
    const minusculas = regexlower.test(strContrasena);

    if (minusculas) {

      
        swal("Atención", "Debe contener al menos una minúscula" , "info");
        return false;

    } 


        let request = window.XMLHttpRequest
          ? new XMLHttpRequest()
          : new ActiveXObject("Microsoft.XMLHTTP");
        let ajaxUrl = base_url + "/Cliente/setCliente";
        let formData = new FormData(formCliente);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function () {
          if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
              /*   if (rowTable == "") {
                tableClientes.api().ajax.reload();
              } else {
                rowTable.cells[1].textContent = strIdentificacion;
                rowTable.cells[2].textContent = strNombre;
                rowTable.cells[3].textContent = strApellido;
                rowTable.cells[4].textContent = strEmail;
                rowTable.cells[5].textContent = intTelefono;
                rowTable = "";
              }*/
              $("#modalFormCliente").modal("hide");
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

    if (document.querySelector("#formClienteM")) {
      let formCliente = document.querySelector("#formClienteM");
      formCliente.onsubmit = function (e) {
        e.preventDefault();


        var strIdentificacion =
          document.querySelector("#txtIdentificacionA").value;
        var strTipo = document.querySelector("#listTipoA").value;
        var strNombre = document.querySelector("#txtNombreA").value;
        var strPrimerApellido =
          document.querySelector("#txtPrimerApellidoA").value;
        var strSegundoApellido = document.querySelector(
          "#txtSegundoApellidoA"
        ).value;
        var strTelefono = document.querySelector("#txtTelefonoA").value;
        var strFecha = document.querySelector("#txtFechaA").value;
        var strCorreo = document.querySelector("#txtCorreoA").value;
        var strContrasena = document.querySelector("#txtContrasenaA").value;
       
    

        if(strContrasena.length < 5 ){
          swal("Atención", "La contraseña debe tener un mínimo de 5 caracteres." , "info");
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

        let request = window.XMLHttpRequest
          ? new XMLHttpRequest()
          : new ActiveXObject("Microsoft.XMLHTTP");
        let ajaxUrl = base_url + "/Cliente/setClienteM";
        let formData = new FormData(formCliente);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function () {
          if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
              /*   if (rowTable == "") {
                tableClientes.api().ajax.reload();
              } else {
                rowTable.cells[1].textContent = strIdentificacion;
                rowTable.cells[2].textContent = strNombre;
                rowTable.cells[3].textContent = strApellido;
                rowTable.cells[4].textContent = strEmail;
                rowTable.cells[5].textContent = intTelefono;
                rowTable = "";
              }*/
              $("#modalFormClienteModificar").modal("hide");
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
    fntTipoDocumento();
    fntParentesco();
    fntTipoDocumentoM();
  },
  false
);

function fntTipoDocumento() {
  var ajaxUrl = base_url + "/Cliente/getSelectTipo";
  var request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  request.open("GET", ajaxUrl, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      document.querySelector("#listTipo").innerHTML = request.responseText;
      document.querySelector("#listTipo").value = 1;
      $("#listTipo").selectpicker("render");
    }
  };
}


function fntTipoDocumentoM() {
  var ajaxUrl = base_url + "/Cliente/getSelectTipo";
  var request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  request.open("GET", ajaxUrl, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      document.querySelector("#listTipoA").innerHTML = request.responseText;
      document.querySelector("#listTipoA").value = 1;
      $("#listTipoA").selectpicker("render");
    }
  };
}



function fntParentesco() {
  var ajaxUrl = base_url + "/Cliente/getSelectParentesco";
  var request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  request.open("GET", ajaxUrl, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      document.querySelector("#listParentesco").innerHTML =
        request.responseText;
      document.querySelector("#listParentesco").value = 1;
      $("#listParentesco").selectpicker("render");
    }
  };
}

function ftnEditCliente(idCliente) {

  document.querySelector("#titleModale").innerHTML = "Actualizar Cliente";
  document
    .querySelector(".modal-heade")
    .classList.replace("header-udate", "headerUpdate");
  document
    .querySelector("#btnActionFormA")
    .classList.replace("btn-primary", "btn-info");
  document.querySelector("#btnTextA").innerHTML = "Actualizar";

  var idcliente = idCliente;
  var request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");

  var ajaxUser = base_url + "/Cliente/getCliente/" + idcliente;
  request.open("GET", ajaxUser, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var objData = JSON.parse(request.responseText);

      if (objData.status) {
        document.querySelector("#idClienteA").value =
          objData.data.idcliente;
        document.querySelector("#txtIdentificacionA").value =
          objData.data.numero_documento_cliente;
        document.querySelector("#listTipoA").value =
          objData.data.idtipodocumento;
        document.querySelector("#txtNombreA").value = objData.data.nombre;
        document.querySelector("#txtPrimerApellidoA").value =
          objData.data.apellido_uno;
        document.querySelector("#txtSegundoApellidoA").value =
          objData.data.apellido_dos;
        document.querySelector("#txtTelefonoA").value =
          objData.data.telefono;
        document.querySelector("#txtFechaA").value =
          objData.data.fechanacimiento;
        document.querySelector("#txtCorreoA").value = objData.data.correo;
        document.querySelector("#txtContrasenaA").value = objData.data.contrasena;
        document.querySelector("#idacudienteA").value = objData.data.idacudiente;

        

     

        //txtTipoA
        //listRolidA
     
        $("#listTipoA").selectpicker("render");
      }
    }
    $("#modalFormClienteModificar").modal("show");
  };

} 


function ftnViewCliente(idCliente) {

  var idcliente = idCliente;

  var request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");

  var ajaxUser = base_url + "/Cliente/getCliente/" + idcliente;
  request.open("GET", ajaxUser, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var objData = JSON.parse(request.responseText);

      if (objData.status) {
        document.querySelector("#celCodigo").innerHTML =
          objData.data.idcliente;
        document.querySelector("#celTipoDocumento").innerHTML =
          objData.data.tipo_documento;
        document.querySelector("#celIdentificacion").innerHTML =
          objData.data.numero_documento_cliente;
        document.querySelector("#celNombre").innerHTML =
          objData.data.nombre;
        document.querySelector("#celPrimerApellido").innerHTML =
          objData.data.apellido_uno;
        document.querySelector("#celSegundoApellido").innerHTML =
          objData.data.apellido_dos;
        document.querySelector("#celTelefono").innerHTML =
          objData.data.telefono;
        document.querySelector("#celFecha").innerHTML =
          objData.data.fechanacimiento;
        document.querySelector("#celCorreo").innerHTML =
          objData.data.correo;
       
        document.querySelector("#celRol").innerHTML = objData.data.cargo;
         
        document.querySelector("#celacudiente").innerHTML = objData.data.idacudiente;
       


        $("#modalViewCliente").modal("show");
      } else {
        swal("Error", objData.msg, "error");
      }
    }
  };

} //

function fntDelCliente(idCliente) {
  
  var idCliente = idCliente;
  

  swal(
    {
      title: "Eliminar cliente ",
      text: "¿Realmente quiere eliminar al cliente?",
      type: "warning",
      showCancelButton: true,
      confirmButtonText: "Si, eliminar!",
      cancelButtonText: "No, cancelar!",
      closeOnConfirm: false,
      closeOnCancel: true,
    },
    function (isConfirm) {
      if (isConfirm) {
        var request = window.XMLHttpRequest
          ? new XMLHttpRequest()
          : new ActiveXObject("Microsoft.XMLHTTP");
        var ajaxUrl = base_url + "/Cliente/delCliente/";
        var strData = "idCliente=" + idCliente;
        
        request.open("POST", ajaxUrl, true);
        request.setRequestHeader(
          "Content-type",
          "application/x-www-form-urlencoded"
        );
        request.send(strData);
        request.onreadystatechange = function () {
          if (request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);

            console.log(objData);

            if (objData.status) {
              swal("Eliminar!", objData.msg, "success");
              tableClientes.api().ajax.reload();
            } else {
              swal("Atención!", objData.msg, "error");
            }
          }
        };
      }
    }
  );

}


function openModal() {
  document.querySelector("#idCliente").value = "";
  document.querySelector(".modal-header") .classList.replace("headerUpdate", "headerRegister");
  document.querySelector("#btnActionForm").classList.replace("btn-info", "btn-primary");
  document.querySelector("#btnText").innerHTML = "Guardar";
  document.querySelector("#titleModal").innerHTML = "Nuevo Cliente";
  document.querySelector("#formCliente").reset();
  $("#modalFormCliente").modal("show");
}
