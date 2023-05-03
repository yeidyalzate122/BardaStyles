var tableEmpleados;

document.addEventListener("DOMContentLoaded", function () {
  tableEmpleados = $("#tableEpleados").dataTable({
    aProcessing: true,
    aServerSide: true,
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
    },
    ajax: {
      url: " " + base_url + "/Empleados/getEmpleados",
      dataSrc: "",
    },
    columns: [
      { data: "idempleado" },
      { data: "numero_documento_empleado" },
      { data: "tipo_documento" },
      { data: "nombre" },
      { data: "apellido_uno" },
      { data: "apellido_dos" },
      { data: "telefono" },
      { data: "fecha_nacimiento" },
      { data: "correo" },
      { data: "eps" },
      { data: "cargo" },
      { data: "options" },
    ],
    resonsieve: "true",
    bDestroy: true,
    iDisplayLength: 4,
    order: [[0, "desc"]],
  });

  if (document.querySelector("#formEmpleado")) {
    var formEmpleado = document.querySelector("#formEmpleado");
    formEmpleado.onsubmit = function (e) {
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
      var strEps = document.querySelector("#listEps").value;
      var strRolid = document.querySelector("#listRolid").value;
      var strStatus = document.querySelector("#txtStatus").value;
      // var strFoto = document.querySelector("#foto").value;
      // var strCertificado = document.querySelector("#Certificado").value;

      if (
        strIdentificacion == "" ||
        strTipo == "" ||
        strNombre == "" ||
        strPrimerApellido == "" ||
        strSegundoApellido == "" ||
        strTelefono == "" ||
        strFecha == "" ||
        strCorreo == "" ||
        strContrasena == "" ||
        strEps == "" ||
        strRolid == "" ||
        strStatus == ""
      ) {
        swal("Atención", "Todos los campos son obligatorios.", "error");
        return false;
      }

      if (strContrasena.length < 5) {
        swal(
          "Atención",
          "La contraseña debe tener un mínimo de 5 caracteres.",
          "info"
        );
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
      var ajaxUrl = base_url + "/Empleados/setEmpleado";
      var formData = new FormData(formEmpleado);
      request.open("POST", ajaxUrl, true);
      request.send(formData);

      request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
          var objData = JSON.parse(request.responseText);
          if (objData.status) {
            $("#modalFormEmpleado").modal("hide");
            formEmpleado.reset();
            swal("Empleado", objData.msg, "success");
           
            tableEmpleados.api().ajax.reload(function () {
              window.location.reload();
              //  ftnViewEmpleado();
              // ftnEditEmpleado();
              // fntRolesUsuario();
              // fntTipoDocumento();
              // fntEps();
              fntEpsM();
              fntTipoDocumentoM();
              fntRolesUsuarioM();
              fntEmpleado().reload();
              //fntDelEmpleado();
            });
          } else {
            swal("Error", objData.msg, "error");
          }
        }
      };
    };
  }

  if (document.querySelector("#formPerfil")) {
    let formPerfil = document.querySelector("#formPerfil");
    formPerfil.onsubmit = function (e) {
      e.preventDefault();
      let strNombre = document.querySelector("#txtNombre").value;
      let strApellido = document.querySelector("#txtApellido").value;
      let strApellidoDos = document.querySelector("#txtApellidoDos").value;
      let intTelefono = document.querySelector("#txtTelefono").value;
      let strCorreo = document.querySelector("#txtEmail").value;
      let strPassword = document.querySelector("#txtPassword").value;
      let strPasswordConfirm = document.querySelector(
        "#txtPasswordConfirm"
      ).value;

      if (
        strApellidoDos == "" ||
        strApellido == "" ||
        strNombre == "" ||
        intTelefono == "" ||
        strCorreo == ""
      ) {
        swal("Atención", "Todos los campos son obligatorios.", "error");
        return false;
      }

      if (strPassword != "" || strPasswordConfirm != "") {
        if (strPassword != strPasswordConfirm) {
          swal("Atención", "Las contraseñas no son iguales.", "info");
          return false;
        }
        if (strPassword.length < 5) {
          swal(
            "Atención",
            "La contraseña debe tener un mínimo de 5 caracteres.",
            "info"
          );
          return false;
        }
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
      let ajaxUrl = base_url + "/Empleados/putPerfil";
      let formData = new FormData(formPerfil);
      request.open("POST", ajaxUrl, true);
      request.send(formData);
      request.onreadystatechange = function () {
        if (request.readyState != 4) return;
        if (request.status == 200) {
          let objData = JSON.parse(request.responseText);
          if (objData.status) {
            $("#modalFormPerfil").modal("hide");
            swal(
              {
                title: "",
                text: objData.msg,
                type: "success",
                confirmButtonText: "Aceptar",
                closeOnConfirm: false,
              },
              function (isConfirm) {
                if (isConfirm) {
                  location.reload();
                }
              }
            );
          } else {
            swal("Error", objData.msg, "error");
          }
        }
        divLoading.style.display = "none";
        return false;
      };
    };
  }

  if (document.querySelector("#formEmpleadoM")) {
    var formEmpleadoM = document.querySelector("#formEmpleadoM");

    formEmpleadoM.onsubmit = function (e) {
      e.preventDefault();

      var strIdentificacion = document.querySelector(
        "#txtIdentificacionA"
      ).value;
      var strTipo = document.querySelector("#listTipoA").value;
      var strNombre = document.querySelector("#txtNombreA").value;
      var strPrimerApellido = document.querySelector(
        "#txtPrimerApellidoA"
      ).value;
      var strSegundoApellido = document.querySelector(
        "#txtSegundoApellidoA"
      ).value;
      var strTelefono = document.querySelector("#txtTelefonoA").value;
      var strFecha = document.querySelector("#txtFechaA").value;
      var strCorreo = document.querySelector("#txtCorreoA").value;
      var strContrasena = document.querySelector("#txtContrasenaA").value;
      var strEps = document.querySelector("#listEpsA").value;
      var strRolid = document.querySelector("#listRolidA").value;
      // var strFoto = document.querySelector("#foto").value;
      var strCertificado = document.querySelector("#listCerA").value;

      var strTitulacionA = document.querySelector("#txtTitulacionA").value;
      var strInstitucionA = document.querySelector("#txInstitucionA").value;
      var strTiempoA = document.querySelector("#txtTiempoA").value;
      var strCertificadoEstudio = document.querySelector("#listCerH").value;

      var STRTipoA = document.querySelector("#txtTipoA").value;
      var strNombreEmpresaA =
        document.querySelector("#txtNombreEmpresaA").value;
      var strFechaInicioA = document.querySelector("#txtFechaInicioA").value;
      var strFechaFinalA = document.querySelector("#txtFechaFinalA").value;
      var strDescripcionA = document.querySelector("#txtDescripcionA").value;

      if (
        strIdentificacion == "" ||
        strTipo == "" ||
        strNombre == "" ||
        strPrimerApellido == "" ||
        strSegundoApellido == "" ||
        strTelefono == "" ||
        strFecha == "" ||
        strCorreo == "" ||
        strEps == "" ||
        strRolid == "" ||
        strTitulacionA == "" ||
        strInstitucionA == "" ||
        strTiempoA == "" ||
        STRTipoA == "" ||
        strNombreEmpresaA == "" ||
        strFechaInicioA == "" ||
        strFechaFinalA == "" ||
        strDescripcionA == ""
      ) {
        swal("Atención", "Todos los campos son obligatorios.", "error");
        return false;
      }

      if (strContrasena.length < 5) {
        swal(
          "Atención",
          "La contraseña debe tener un mínimo de 5 caracteres.",
          "info"
        );
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
      var ajaxUrl = base_url + "/Empleados/setEmpleadoM";
      var formData = new FormData(formEmpleadoM);
      request.open("POST", ajaxUrl, true);
      request.send(formData);

      request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
          var objData = JSON.parse(request.responseText);
          if (objData.status) {
            $("#modalFormEmpleadoModificar").modal("hide");
            formEmpleadoM.reset();
            swal("Empleado", objData.msg, "success");
            tableEmpleados.api().ajax.reload(function () {
              //  ftnViewEmpleado();
              //ftnEditEmpleado();
              /*fntRolesUsuario();
            fntTipoDocumento();
            fntEps();
            fntEpsM();
            fntTipoDocumentoM();
            fntRolesUsuarioM();*/
              // fntDelEmpleado();
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
    //ftnViewEmpleado();
    //  ftnEditEmpleado();
    fntRolesUsuario();
    fntTipoDocumento();
    fntEps();
    fntEpsM();
    fntTipoDocumentoM();
    fntRolesUsuarioM();
    //fntTipoEstudioM();
  
    
    //fntEstadoHHA();
    // fntDelEmpleado();
  },
  false
);

if (document.querySelector("#listRolid")) {
  function fntRolesUsuario() {
    var ajaxUrl = base_url + "/Roles/getSelectRoles";
    var request = window.XMLHttpRequest
      ? new XMLHttpRequest()
      : new ActiveXObject("Microsoft.XMLHTTP");
    request.open("GET", ajaxUrl, true);
    request.send();

    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        document.querySelector("#listRolid").innerHTML = request.responseText;
        //document.querySelector("#listRolid").value = 1;
        $("#listRolid").selectpicker("render");
      }
    };
  }
}

function fntTipoDocumento() {
  var ajaxUrl = base_url + "/Empleados/getSelectTipo";
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

function fntEps() {
  var ajaxUrl = base_url + "/Empleados/getSelectEps";
  var request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  request.open("GET", ajaxUrl, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      document.querySelector("#listEps").innerHTML = request.responseText;
      document.querySelector("#listEps").value = 1;
      $("#listEps").selectpicker("render");
    }
  };
}


 


///modicicar

function fntTipoEstudioM() {
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

function fntEpsM() {
  var ajaxUrl = base_url + "/Empleados/getSelectEps";
  var request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  request.open("GET", ajaxUrl, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      document.querySelector("#listEpsA").innerHTML = request.responseText;
      document.querySelector("#listEpsA").value = 1;
      $("#listEpsA").selectpicker("render");
    }
  };
}

function fntTipoDocumentoM() {
  var ajaxUrl = base_url + "/Empleados/getSelectTipo";
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

function fntRolesUsuarioM() {
  var ajaxUrl = base_url + "/Roles/getSelectRoles";
  var request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  request.open("GET", ajaxUrl, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      document.querySelector("#listRolidA").innerHTML = request.responseText;
      document.querySelector("#listRolidA").value = 1;
      $("#listRolidA").selectpicker("render");
    }
  };
}

function ftnEditEmpleado(idEmpleado) {
  document.querySelector("#titleModale").innerHTML = "Actualizar empleado";
  document
    .querySelector(".modal-heade")
    .classList.replace("header-udate", "headerUpdate");
  document
    .querySelector("#btnActionFormA")
    .classList.replace("btn-primary", "btn-info");
  document.querySelector("#btnTextA").innerHTML = "Actualizar";

  var idempleado = idEmpleado;
  var request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");

  var ajaxUser = base_url + "/Empleados/getEmpleado/" + idempleado;
  request.open("GET", ajaxUser, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var objData = JSON.parse(request.responseText);

      if (objData.status) {
        document.querySelector("#idEmpleadoA").value = objData.data.idempleado;
        document.querySelector("#txtIdentificacionA").value =
          objData.data.numero_documento_empleado;
        document.querySelector("#listTipoA").value =
          objData.data.idtipodocumento;
        document.querySelector("#txtNombreA").value = objData.data.nombre;
        document.querySelector("#txtPrimerApellidoA").value =
          objData.data.apellido_uno;
        document.querySelector("#txtSegundoApellidoA").value =
          objData.data.apellido_dos;
        document.querySelector("#txtTelefonoA").value = objData.data.telefono;
        document.querySelector("#txtFechaA").value =
          objData.data.fecha_nacimiento;
        document.querySelector("#txtCorreoA").value = objData.data.correo;
        document.querySelector("#txtContrasenaA").value =
          objData.data.contrasena;

        document.querySelector("#listEpsA").value = objData.data.ideps;

        document.querySelector("#listRolidA").value = objData.data.rolid;

        document.querySelector("#listCerA").value =
          objData.data.urlcertificado_bioseguridad;

        document.querySelector("#txtTitulacionA").value =
          objData.data.titulacion;
        document.querySelector("#txInstitucionA").value =
          objData.data.institucion;
        document.querySelector("#txtTiempoA").value =
          objData.data.tiempo_estudio;
        document.querySelector("#txtTipo").value = objData.data.idtipoestudio;

        document.querySelector("#listCerH").value =
          objData.data.url_certificado;

        document.querySelector("#txtNombreEmpresaA").value =
          objData.data.nombre_empresa;
        document.querySelector("#txtFechaInicioA").value =
          objData.data.fecha_inicio;

        document.querySelector("#txtFechaFinalA").value =
          objData.data.fecha_final;

        document.querySelector("#txtDescripcionA").value =
          objData.data.funciones;

        //txtTipoA
        //listRolidA

        if(objData.data.url_certificado == 1){
          document.querySelector("#listCerH").value = 1;
      }else{
          document.querySelector("#listCerH").value = 2;
      }
     
      if(objData.data.urlcertificado_bioseguridad == 1){
        document.querySelector("#listCerA").value = 1;
    }else{
        document.querySelector("#listCerA").value = 2;
    }



        $("#listCerA").selectpicker("render");
        $("#listCerH").selectpicker("render");
        $("#listRolidA").selectpicker("render");
        $("#txtTipoA").selectpicker("render");
        $("#listEpsA").selectpicker("render");
        $("#listTipoA").selectpicker("render");
      }
    }
    $("#modalFormEmpleadoModificar").modal("show");
  };
}

function ftnViewEmpleado(idEmpleado) {
  var idempleado = idEmpleado;

  var request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");

  var ajaxUser = base_url + "/Empleados/getEmpleado/" + idempleado;
  request.open("GET", ajaxUser, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var objData = JSON.parse(request.responseText);

      if (objData.status) {

        let certificado =
        objData.data.url_certificado == 1
          ? '<span class="badge badge-success">Si</span>'
          : '<span class="badge badge-danger">No</span>';

          let certificado_bio =
          objData.data.urlcertificado_bioseguridad == 1
            ? '<span class="badge badge-success">Si</span>'
            : '<span class="badge badge-danger">No</span>';
  

            document.querySelector("#celCertificadoBio").innerHTML = certificado_bio;
            document.querySelector("#celCertificadoEstudio").innerHTML = certificado;



        document.querySelector("#celCodigo").innerHTML =
          objData.data.idempleado;
        document.querySelector("#celTipoDocumento").innerHTML =
          objData.data.tipo_documento;
        document.querySelector("#celIdentificacion").innerHTML =
          objData.data.numero_documento_empleado;
        document.querySelector("#celNombre").innerHTML = objData.data.nombre;
        document.querySelector("#celPrimerApellido").innerHTML =
          objData.data.apellido_uno;
        document.querySelector("#celSegundoApellido").innerHTML =
          objData.data.apellido_dos;
        document.querySelector("#celTelefono").innerHTML =
          objData.data.telefono;
        document.querySelector("#celFecha").innerHTML =
          objData.data.fecha_nacimiento;
        document.querySelector("#celCorreo").innerHTML = objData.data.correo;
        document.querySelector("#celEps").innerHTML = objData.data.eps;
        document.querySelector("#celRol").innerHTML = objData.data.cargo;
        document.querySelector("#celCertificadoBio").innerHTML =
          objData.data.urlcertificado_bioseguridad;

        document.querySelector("#celCertificadoEstudio").innerHTML =
          objData.data.url_certificado;

        document.querySelector("#celTitulacion").innerHTML =
          objData.data.titulacion;
        document.querySelector("#celInstitucion").innerHTML =
          objData.data.institucion;
        document.querySelector("#celTiempo").innerHTML =
          objData.data.tiempo_estudio;
        document.querySelector("#celTipoEstudio").innerHTML =
          objData.data.tipo_estudio;
        document.querySelector("#celNombreEmpresa").innerHTML =
          objData.data.nombre_empresa;
        document.querySelector("#celFechaInicio").innerHTML =
          objData.data.fecha_inicio;
        document.querySelector("#celFechaFinal").innerHTML =
          objData.data.fecha_final;
        document.querySelector("#celDescripcion").innerHTML =
          objData.data.funciones;

        $("#modalViewEmpleado").modal("show");
      } else {
        swal("Error", objData.msg, "error");
      }
    }
  };
}

function fntDelEmpleado(idEmpleado) {
  var idEmpleado = idEmpleado;

  swal(
    {
      title: "Eliminar empleado ",
      text: "¿Realmente quiere eliminar el empleado?",
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
        var ajaxUrl = base_url + "/Empleados/delEmpleado/";
        var strData = "idEmpleado=" + idEmpleado;
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
              tableEmpleados.api().ajax.reload();
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
  document.querySelector("#idEmpleado").value = "";
  document
    .querySelector(".modal-header")
    .classList.replace("headerUpdate", "headerRegister");
  document
    .querySelector("#btnActionForm")
    .classList.replace("btn-info", "btn-primary");
  document.querySelector("#btnText").innerHTML = "Guardar";
  document.querySelector("#titleModal").innerHTML = "Nuevo Empleado";
  document.querySelector("#formEmpleado").reset();
  $("#modalFormEmpleado").modal("show");
}

//formulario historial

document.addEventListener(
  "DOMContentLoaded",
  function () {
    if (document.querySelector("#formHistorialE")) {
      var formHistorial = document.querySelector("#formHistorialE");

      formHistorial.onsubmit = function (e) {
        e.preventDefault();
        //estudio
        var strEmpleado = document.querySelector("#listEmpleado").value;
        var strTitulacion = document.querySelector("#txtTitulacion").value;
        var strInstitucion = document.querySelector("#txInstitucion").value;
        var strTiempo = document.querySelector("#txtTiempo").value;
        var strCertificacion = document.querySelector("#listCerAA").value;
        var strTipo = document.querySelector("#txtTipo").value;

        //experiencia aboral
        var strNombreEmpresa =
          document.querySelector("#txtNombreEmpresa").value;
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
            swal(
              "Atención",
              "Por favor verifique los campos en rojo.",
              "error"
            );
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
              tableEmpleados.api().ajax.reload();
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
  
    fntEmpleado();
    fntTipoEstudio();
    fntTipoEstudioA();
 
  },
  false
);




//
if (document.querySelector("#txtTipo")) {
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
}

if (document.querySelector("#txtTipoA")) {
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
}

if (document.querySelector("#listEmpleado")) {
  function fntEmpleado() {
    var ajaxUrl = base_url + "/Empleados/getSelectEmpleado";
    var request = window.XMLHttpRequest
      ? new XMLHttpRequest()
      : new ActiveXObject("Microsoft.XMLHTTP");
    request.open("GET", ajaxUrl, true);
    request.send();

    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        document.querySelector("#listEmpleado").innerHTML =
          request.responseText;
        document.querySelector("#listEmpleado").value = 1;
        $("#listEmpleado").selectpicker("render");
      }
    };
  }
}

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

function openModalPerfil() {
  $("#modalFormPerfil").modal("show");
}
