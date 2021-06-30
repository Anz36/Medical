

$('#form-file').submit(function(e) {
    const postData = {
        fecha: $('#fileDate').val(),
    };
    $.post('../Reportes/php/reportepdf.php', postData, function(response){
        window.open(response, '_blank');
    });
    e.preventDefault();
});

$('#form-file2').submit(function(e) {
    const postData = {
        fecha1: $('#fileDateF1').val(),
        fecha2: $('#fileDateF2').val(),
    };
    $.post('../Reportes/php/reportelargopdf.php', postData, function(response){
        window.open(response, '_blank');
    });
    e.preventDefault();
});

$(document).on('click','.btnCerrarSession', function(){
    $.ajax({
        url: '../Usuarios/php/task-logout.php',
        type: 'GET',
        success: function(response){
            window.location.href = '../../Login/';
        }
    });
});



$(document).on('click','.btnPerfil',function(){
    $.post('../php/task-view-user.php',function(response){
        const task = JSON.parse(response);
        $('#pacienteDNIPerfil').val(task.dni);
        $('#pacienteNombrePerfil').val(task.nombre);
        $('#pacienteGeneroPerfil').val(task.genero);
        $('#pacienteNacimientoPerfil').val(task.nacimiento);
        $('#pacienteTelefonoPerfil').val(task.telefono);
        $('#pacienteEmailPerfil').val(task.email);
    })
});

$(document).on('click','.btnEditarUsuario',function(){
    if(confirm('¿Esta seguro de restablecer la contraseña?')){
        let element = $(this)[0].parentElement.parentElement;
        let id = $(element).attr('taskId');
        console.log(id);
        $.post('../Usuarios/php/task-refresh-user.php',{id},function(response){
            if(response === 'Refresh'){
                alert('Se ha restablecido la contraseña, debera probar con la Siguiente contraseña 123ABC123');
            } else {
                alert('Ha fallado con el intento de restablecer.');
            }
        })
    }
    
});


$('#form-editPerfil').submit(function(e){
    const postData = {
        dni: $('#pacienteDNIPerfil').val(),
        nombre: $('#pacienteNombrePerfil').val(),
        genero: $('#pacienteGeneroPerfil').val(),
        nacimiento: $('#pacienteNacimientoPerfil').val(),
        telefono: $('#pacienteTelefonoPerfil').val(),
        email: $('#pacienteEmailPerfil').val()
    }
    $.post('../php/task-update-user.php',postData, function(response){
        if(response === 'Update'){
            alert('Su Perfil a sido editado');
        } else {
            alert('Su Perfil a no se ha podido editar');
        }
    });
});

$('#form-edit-password').submit(function(e){
    const postData = {
        palabraActual: $('#pacienteClaveActualPerfil').val(),
        palabraNueva: $('#pacienteNuevaClavePerfil').val()
    }
    $.post('../php/task-change-password.php',postData, function(response){
        if(response === 'Change Password'){
            alert('Su contraseña se ha cambiado');
        }else {
            alert('No se ha podido cambiar, revise su contraseña');
        }
    });
    e.preventDefault();
});