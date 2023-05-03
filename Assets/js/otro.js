function strong_password() {
    $('#pass').popover('dispose');



    var contrasena = $("#pass").val();
    $("#texto-longitud").empty();
    $("#texto-minusculas").empty();
    $("#texto-mayusculas").empty();
    $("#texto-numeros").empty();

    var validadorlong = false;
    var validadormay = false;
    var validadormin = false;
    var validadornum = false;

    var txt_longitud, txt_mayusculas, txt_minusculas, txt_numeros;





    if (contrasena.length < 8 || contrasena.length > 20) {


        txt_longitud = '<div id="texto-longitud"><p class="text-danger"><i class="fa fa-times-circle"></i>&nbsp;Debe contener entre 8 y 20 caracteres</p></div>';
        var validadorlong = false;
    } else {



        txt_longitud = '<div id="texto-longitud"><p class="text-success"><i class="fa fa-check-circle"></i>&nbsp;Debe contener entre 8 y 20 caracteres</p></div>';
        var validadorlong = true;

    }


    // Regular expression
    const regexlower = /[a-z]/;

    // Check if string contians numbers
    const minusculas = regexlower.test(contrasena);

    if (minusculas) {

        txt_minusculas = '<div id="texto-minusculas"><p class="text-success"><i class="fa fa-check-circle"></i>&nbsp;Debe contener al menos una minúscula</p></div>';
        validadormin = true;


    } else {



        txt_minusculas = '<div id="texto-minusculas"><p class="text-danger"><i class="fa fa-times-circle"></i>&nbsp;Debe contener al menos una minúscula</p></div>';
        validadormin = false;


    }


    // Regular expression
    const regexnumber = /\d/;

    // Check if string contians numbers
    const numeros = regexnumber.test(contrasena);

    if (numeros) {

        txt_numeros = '<div id="texto-numeros"><p class="text-success"><i class="fa fa-check-circle"></i>&nbsp;Debe contener al menos un número</p></div>';
        validadornum = true;

    } else {


        txt_numeros = '<div id="texto-numeros"><p class="text-danger"><i class="fa fa-times-circle"></i>&nbsp;Debe contener al menos un número</p></div>';
        validadornum = false;


    }


    // Regular expression
    const regexupper = /[A-Z]/;

    // Check if string contians numbers
    const mayusculas = regexupper.test(contrasena);

    if (mayusculas) {

        txt_mayusculas = '<div id="texto-mayusculas"><p class="text-success"><i class="fa fa-check-circle"></i>&nbsp;Debe contener al menos una mayúscula</p></div>';
        validadormay = true;

    } else {


        txt_mayusculas = '<div id="texto-mayúsculas"><p class="text-danger"><i class="fa fa-times-circle"></i>&nbsp;Debe contener al menos una mayúscula</p></div>';
        validadormay = false;

    }

    if (validadorlong == true && validadormay == true && validadormin == true && validadornum == true) {
        $("#passvalidator").val("true");
    } else {
        $("#passvalidator").val("false")
    }

    $('#pass').popover({
        trigger: 'focus',
        html: true,
        content: function() {
            var message = '<div id="indicadores-contrasena">' + txt_longitud + txt_minusculas + txt_mayusculas + txt_numeros + '</div>';
            return message;
        }
    });

    $('#pass').popover('show');




    return false;
}