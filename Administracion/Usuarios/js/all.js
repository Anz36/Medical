fetchList();
fetchPaciente();

$('#searchUsuario').keyup(function(){
    if(($('#searchUsuario').val()) !== ""){
        let search = $('#searchUsuario').val();
        $.ajax({
            url: '../Usuarios/php/task-search.php',
            type: 'POST',
            data: {search},
            success: function(response){
                console.log(response);
                let task = JSON.parse(response);
                console.log(response);
                let template = '';
                task.forEach(tasks =>{
                    template +=`
                        <tr taskId="${tasks.id}">
                        <td>
                        <a  class = "btn btn-ligth btnEditarUsuario btn-md rounded-pill" data-toggle="modal" data-target="#myModalEditarUsuario"> <i class="fas fa-sync fa-2x text-primary" title = "Atender"></i> </a>
                        </td>
                        <td class="align-center">${tasks.usuario}</td>
                        <td>${tasks.tipo}</td>
                        </tr>
                    `
                });
                $('#contenidoUsuarios').html(template);
            }
        })
    } else {
        fetchList();
    }
});



$('#form-add-user-paciente').submit(function(e) {
    const postData = {
        pacienteDNI: $('#pacienteDNI').val(),
        claveSecreta: $('#claveSecreta').val(),
        claveSecretaConfirmar: $('#claveSecretaConfirmar').val(),
    };
    $.post('../Usuarios/php/task-add-user-p.php', postData, function(response){
        if(response === 'Add'){
            $('#form-add-user-paciente').trigger('reset');
            alert('Se Agrego el Usuario Paciente');
            fetchList();
        } else {
            if(response === 'Clave Incorrecta'){
                alert('Verificar las Claves');
            } else {
                alert('Usuario ya existente.');
            }    
        } 
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

$('#form-add-user-admin').submit(function(e) {
    const postData = {
        personaDNI: $('#personaDNI').val(),
        claveSecretaA: $('#claveSecretaA').val(),
        claveSecretaConfirmarA: $('#claveSecretaConfirmarA').val(),
    };
    $.post('../Usuarios/php/task-add-user-a.php', postData, function(response){
        if(response === 'Add'){
            $('#form-add-user-admin').trigger('reset');
            alert('Se Agrego el Usuario Paciente');
            fetchList();
        } else {
            if(response === 'Clave Incorrecta'){
                alert('Verificar las Claves');
            } else {
                alert('Usuario ya existente.');
            }    
        } 
    });
    e.preventDefault();
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
function fetchPaciente(){
    $.ajax({
        url: '../Usuarios/php/task-list-pacient.php',
        type: 'GET',
        success: function(response){
            let task = JSON.parse(response);
            let template = '';
            task.forEach(tasks =>{
                template +=`
                <option value="${tasks.id}">${tasks.id}</option>
                `
            });
            $('#pacienteDNI').html(template);
            $('#personaDNI').html(template);
        }
    });
}

function fetchList(){
    $.ajax({
        url: '../Usuarios/php/task-list-all.php',
        type: 'GET',
        success: function(response){
            let task = JSON.parse(response);
            let template = '';
            task.forEach(tasks =>{
                    template +=`
                        <tr taskId="${tasks.id}">
                        <td>
                            <a  class = "btn btn-ligth btnEditarUsuario btn-md rounded-pill" data-toggle="modal" data-target="#myModalEditarUsuario"> <i class="fas fa-sync fa-2x text-primary" title = "Atender"></i> </a>
                            </td>
                            <td class="align-center">${tasks.usuario}</td>
                            <td>${tasks.tipo}</td>
                        </tr>
                    `
                });
                $('#contenidoUsuarios').html(template);
            }
    });
}
