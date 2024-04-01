function verificar() {

    event.preventDefault(); //-> Cancelamos el evento del submit.
    //COMPROBACIONES

    var email = document.getElementById("Lemail");
    var pass = document.getElementById("Lpasswd");
    var verify_email = false;
    var verify_pass = false;

    if (email.value === null || email.value === '') {
        //alert("Introduzca un valor, el campo es obligatorio.");
        $("#msjerroremail").addClass('alertform alert alert-danger');
        document.getElementById('msjerroremail').innerHTML = 'Debes ingresar un email ';
        verify_email = false;
    } else {

        verify_email = true;
        $("#msjerroremail").removeClass('alertform alert alert-danger');
        document.getElementById('msjerroremail').innerHTML = ' ';
    }
    if (pass.value === null || pass.value === '') {
        //alert("Introduzca un valor, el campo es obligatorio.");
        $("#msjerrorpass").addClass('alertform alert alert-danger');
        document.getElementById('msjerrorpass').innerHTML = 'Debes ingresar una password';
        verify_pass = false;
    } else {
        $("#msjerrorpass").removeClass('alertform alert alert-danger');
        document.getElementById('msjerrorpass').innerHTML = ' ';
        verify_pass = true;
    }
    if (verify_email && verify_pass) {
//$("#btnlogin").click(function(){
        $("#loginform").submit();

//});
    }
}


//$("#Catform").on('submit', function(evt){
//  evt.preventDefault();  
// tu codigo aqui

function verificar_cat(event) {
    // esta linea detiene la ejecucion del submit
    event.preventDefault(); //-> Cancelamos el evento del submit.
    //COMPROBACIONES

    var namaCat = document.getElementById("nameCat").value;

    var verify_namaCat = false;


    if (namaCat === null || namaCat === '') {

        //alert("Introduzca un valor, el campo es obligatorio.");
        $("#errorcatadd").addClass('alertform alert alert-danger');
        document.getElementById('errorcatadd').innerHTML = 'Debes ingresar una categoria ';
        verify_namaCat = false;
    } else {

        verify_namaCat = true;

        $("#errorcatadd").removeClass('alertform alert alert-danger');
        document.getElementById('errorcatadd').innerHTML = ' ';
    }

    if (verify_namaCat == true) {

        //event.target.submit();
        $("#Catform").submit();
//$("#btnlogin").click(function(){
        //$("#Catform").submit();

//});
    }
}

function verificar_cat_edit(event, id) {
    // esta linea detiene la ejecucion del submit
    event.preventDefault(); //-> Cancelamos el evento del submit.
    //COMPROBACIONES

    var namaCat = document.getElementById("input" + id).value;
    var verify_namaCat = false;


    if (namaCat === null || namaCat === '') {

        //alert("Introduzca un valor, el campo es obligatorio.");
        $("#errorcatedit" + id).addClass('alertform alert alert-danger');
        document.getElementById('errorcatedit' + id).innerHTML = 'Debes ingresar una categoria ';
        verify_namaCat = false;

    } else {

        verify_namaCat = true;

        $("#errorcatedit" + id).removeClass('alertform alert alert-danger');
        document.getElementById('errorcatedit' + id).innerHTML = ' ';
    }

    if (verify_namaCat == true) {

    
        $("#edit_cate" + id).submit();

    }
}