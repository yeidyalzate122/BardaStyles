function openModal() {
  document.querySelector("#idCliente").value = "";
  document
    .querySelector(".modal-header")
    .classList.replace("headerUpdate", "headerRegister");
  document
    .querySelector("#btnActionForm")
    .classList.replace("btn-info", "btn-primary");
  document.querySelector("#btnText").innerHTML = "Guardar";
  document.querySelector("#titleModal").innerHTML = "Nuevo Cliente";
  document.querySelector("#formCliente").reset();
  $("#modalFormCliente").modal("show");
}

$('.login-content [data-toggle="flip"]').click(function () {
  $(".login-box").toggleClass("flipped");
  return false;
});

var divLoading = document.querySelector("#divLoading");
document.addEventListener(
  "DOMContentLoaded",
  function () {
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



        if (strContrasena.length < 5) {
          swal(
            "Atención",
            "La contraseña debe tener un mínimo de 5 caracteres.",
            "info"
          );
          return false;
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
        let ajaxUrl = base_url + "/Longincliente/setCliente";
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
            } else {
              swal("Error", objData.msg, "error");
            }
          }
          divLoading.style.display = "none";
          return false;
        };
      };
    }

    if (document.querySelector("#formLoginClie")) {
      let formLogin = document.querySelector("#formLoginClie");
      formLogin.onsubmit = function (e) {
        e.preventDefault();

        let strIdentidad = document.querySelector("#txtIdentidadClie").value;
        let strPassword = document.querySelector("#txtPasswordClie").value;

        if (strIdentidad == "" || strPassword == "") {
          swal("Por favor", "Escribe usuario y contraseñaa.", "error");
          return false;
        } else {
          divLoading.style.display = "flex";
          var request = window.XMLHttpRequest
            ? new XMLHttpRequest()
            : new ActiveXObject("Microsoft.XMLHTTP");
          var ajaxUrl = base_url + "/Longincliente/loginUserClie";
          var formData = new FormData(formLogin);
          request.open("POST", ajaxUrl, true);
          request.send(formData);

          request.onreadystatechange = function () {
            if (request.readyState != 4) return;
            if (request.status == 200) {
              var objData = JSON.parse(request.responseText);
              if (objData.status) {
                window.location = base_url + "/dashboard";
                //window.location.reload(false);
              } else {
                swal("Atención", objData.msg, "error");
                document.querySelector("#txtPasswordClie").value = "";
              }
            } else {
              swal("Atención", "Error en el proceso", "error");
            }
            divLoading.style.display = "none";
            return false;
          };
        }
      };
    }

    if (document.querySelector("#formRecetPass")) {
      let formRecetPass = document.querySelector("#formRecetPass");
      formRecetPass.onsubmit = function (e) {
        e.preventDefault();

        let strEmail = document.querySelector("#txtEmailResetC").value;
        if (strEmail == "") {
          swal("Por favor", "Escribe tu correo electrónico.", "error");
          return false;
        } else {
          divLoading.style.display = "flex";
          var request = window.XMLHttpRequest
            ? new XMLHttpRequest()
            : new ActiveXObject("Microsoft.XMLHTTP");

          var ajaxUrl = base_url + "/Longincliente/resetPass";
          var formData = new FormData(formRecetPass);
          request.open("POST", ajaxUrl, true);
          request.send(formData);
          request.onreadystatechange = function () {
            if (request.readyState != 4) return;

            if (request.status == 200) {
              var objData = JSON.parse(request.responseText);
              if (objData.status) {
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
                      window.location = base_url;
                    }
                  }
                );
              } else {
                swal("Atención", objData.msg, "error");
              }
            } else {
              swal("Atención", "Error en el proceso", "error");
            }
            divLoading.style.display = "none";
            return false;
          };
        }
      };
    }

    if (document.querySelector("#formCambiarPass")) {
      let formCambiarPass = document.querySelector("#formCambiarPass");
      formCambiarPass.onsubmit = function (e) {
        e.preventDefault();

        let strPassword = document.querySelector("#txtPassword").value;
        let strPasswordConfirm = document.querySelector(
          "#txtPasswordConfirm"
        ).value;
        let idUsuario = document.querySelector("#idUsuario").value;

        if (strPassword == "" || strPasswordConfirm == "") {
          swal("Por favor", "Escribe la nueva contraseña.", "error");
          return false;
        } else {
          if (strPassword.length < 5) {
            swal(
              "Atención",
              "La contraseña debe tener un mínimo de 5 caracteres.",
              "info"
            );
            return false;
          }
          if (strPassword != strPasswordConfirm) {
            swal("Atención", "Las contraseñas no son iguales.", "error");
            return false;
          }
          divLoading.style.display = "flex";
          var request = window.XMLHttpRequest
            ? new XMLHttpRequest()
            : new ActiveXObject("Microsoft.XMLHTTP");
          var ajaxUrl = base_url + "/Longincliente/setPassword";
          var formData = new FormData(formCambiarPass);
          request.open("POST", ajaxUrl, true);
          request.send(formData);
          request.onreadystatechange = function () {
            if (request.readyState != 4) return;
            if (request.status == 200) {
              var objData = JSON.parse(request.responseText);
              if (objData.status) {
                swal(
                  {
                    title: "",
                    text: objData.msg,
                    type: "success",
                    confirmButtonText: "Iniciar sessión",
                    closeOnConfirm: false,
                  },
                  function (isConfirm) {
                    if (isConfirm) {
                      window.location = base_url + "/longincliente";
                    }
                  }
                );
              } else {
                swal("Atención", objData.msg, "error");
              }
            } else {
              swal("Atención", "Error en el proceso", "error");
            }
            divLoading.style.display = "none";
          };
        }
      };
    }
  },
  false
);

//cliente

window.addEventListener(
  "load",
  function () {
    fntTipoDocumento();
    fntParentesco();
  },
  false
);
function fntParentesco() {
  var ajaxUrl = base_url + "/Longincliente/getSelectParentesco";
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
     // $("#listParentesco").selectpicker("render");
    }
  };
}
function fntTipoDocumento() {
  var ajaxUrl = base_url + "/Longincliente/getSelectTipo";
  var request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  request.open("GET", ajaxUrl, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      document.querySelector("#listTipo").innerHTML = request.responseText;
      document.querySelector("#listTipo").value = 1;
     // $("#listTipo").selectpicker("render");
    }
  };
}
