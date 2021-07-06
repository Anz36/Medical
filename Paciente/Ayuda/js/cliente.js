fetchUser();
$('#form-email').submit(function(e) {
    const postData = {
        asuntoEmail: $('#asuntoEmail').val(),
        mensajeEmail: $('#mensajeEmail').val(),
    };
    $.post('../Ayuda/php/task-email.php', postData, function(response){
        console.log(response);
        if(response === 'Send'){
            alert('Su correo se ha recibido de forma satisfactoria.');
            $('#form-email').trigger('reset');
        } else {
            alert('Ha ocurrido un error');
        }
        
    });
    e.preventDefault();
});

$(document).on('click','.btnCerrarSession', function(){
    $.ajax({
        url: '../php/task-logout.php',
        type: 'GET',
        success: function(response){
            window.location.href = '../Login/';
        }
    });
});



$(document).on('click','.btnEditar',function(){
    let element = $(this)[0].parentElement.parentElement;
    let id = $(element).attr('taskId');
    $.post('../php/task-view-cliente.php', {id}, function(response){
        const task = JSON.parse(response);
        $('#clienteEdit').val(task.name);
        $('#emailEdit').val(task.email);
        $('#telefonoEdit').val(task.phone);
        $('#celularEdit').val(task.movil);
        $('#direccionEdit').val(task.address);
        $('#posicionEdit').val(task.position);
        $('#distritoEdit').val(task.district);
        $('#provinciaEdit').val(task.province);
        $('#idClienteEdit').val(task.id);
    });
    $.post('../php/task-view-empresa.php', {id}, function(e){
        const task_business = JSON.parse(e);
        $('#datoEmpresaAll').val(task_business.id);
    });
});

$('#edit-form').submit(function(e){
    const postData = {
        name: $('#clienteEdit').val(),
        email: $('#emailEdit').val(),
        telefono: $('#telefonoEdit').val(),
        celular: $('#celularEdit').val(),
        direccion: $('#direccionEdit').val(),
        posicion: $('#posicionEdit').val(),
        distrito: $('#distritoEdit').val(),
        provincia: $('#provinciaEdit').val(),
        empresa: $('#datoEmpresaAll').val(),
        id: $('#idClienteEdit').val()
    };
    $.post('../php/task-edit-cliente.php', postData, function(response){
        fetchList();
    });
    e.preventDefault();
});


$(document).on('click','.btnPerfil',function(){
    $.post('../php/task-view-user.php',function(response){
        const task = JSON.parse(response);
        $('#nombrePerfil').val(task.nombre);
        $('#apellidoPerfil').val(task.apellidos);
        $('#cumpleañosPerfil').val(task.cumpleaños);
        $('#telefonoPerfil').val(task.telefono);
        $('#emailPerfil').val(task.email);
    })
});

$('#form-editPerfil').submit(function(e){
    const postData = {
        nombre: $('#nombrePerfil').val(),
        apellidos: $('#apellidoPerfil').val(),
        cumpleaños: $('#cumpleañosPerfil').val(),
        telefono: $('#telefonoPerfil').val(),
        email: $('#emailPerfil').val()
    }
    $.post('../php/task-update-user.php',postData, function(response){
        alert('Su Perfil a sido editado');
    });
});

function fetchUser(){
    $.ajax({
        url: '../php/task-search-user.php',
        type: 'GET',
        success: function(response){
            const task = JSON.parse(response);
            $('#userName').html(task.name);
            $('#userNameTwo').html(task.name);
            $('#userType').html(task.type);
        }
    });
}