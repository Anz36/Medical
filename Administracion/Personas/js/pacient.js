fetchList();

$('#searchPaciente').keyup(function(){
    if(($('#searchPaciente').val()) !== ""){
        let search = $('#searchPaciente').val();
        $.ajax({
            url: '../Personas/php/task-search.php',
            type: 'POST',
            data: {search},
            success: function(response){
                console.log(response);
                let task = JSON.parse(response);
                console.log(response);
                let template = '';
                task.forEach(tasks =>{
                    template +=`
                        <tr taskId="${tasks.dni}">
                        <td>
                            <a  class = "btn btn-ligth btnEditarPaciente btn-md rounded-pill" data-toggle="modal" data-target="#myModalEditarPaciente"> <i class="fas fa-edit fa-2x text-primary" title = "Editar"></i> </a>
                            </td>
                            <td class="align-center">${tasks.dni}</td>
                            <td>${tasks.nombre}</td>
                            <td>${tasks.telefono}</td>
                            <td>${tasks.email}</td>
                            <td>${tasks.genero}</td>
                        </tr>
                    `
                });
                $('#contenidoPaciente').html(template);
            }
        })
    } else {
        fetchList();
    }
});



$('#form-add-paciente').submit(function(e) {
    const postData = {
        pacienteNombre: $('#pacienteNombre').val(),
        pacienteEmail: $('#pacienteEmail').val(),
        pacienteTelefono: $('#pacienteTelefono').val(),
        pacienteNacimiento: $('#pacienteNacimiento').val(),
        pacienteGenero: $('#pacienteGenero').val(),
        pacienteDni: $('#pacienteDni').val()
    };
    $.post('../Personas/php/task-add-paciente.php', postData, function(response){
        console.log(response);
        if(response === 'Add'){
            $('#form-add-paciente').trigger('reset');
            alert('Se agregó');
            fetchList();
        } else {
            alert('Verifica los datos');
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


$(document).on('click','.btnEditarPaciente',function(){
    let element = $(this)[0].parentElement.parentElement;
    let id = $(element).attr('taskId');
    $.post('../Personas/php/task-view-pacient.php', {id}, function(response){
        const task = JSON.parse(response);
        $('#nombrePaciente').val(task.nombre);
        $('#emailPaciente').val(task.email);
        $('#telefonoPaciente').val(task.telefono);
        $('#nacimientoPaciente').val(task.nacimiento);
        $('#generoPaciente').val(task.genero);
        $('#dniPaciente').val(task.dni);
    });
});

$('#form-edit-paciente').submit(function(e){
    const postData = {
        id: $('#dniPaciente').val(),
        nombre: $('#nombrePaciente').val(),
        genero: $('#generoPaciente').val(),
        nacimiento: $('#nacimientoPaciente').val(),
        telefono: $('#telefonoPaciente').val(),
        email: $('#emailPaciente').val()
    }
    console.log(postData);
    $.post('../Personas/php/task-update-pacient.php',postData, function(response){
        console.log(response);
        if(response === 'Update'){
            alert('Su Perfil a sido editado');
            fetchList();
        } else {
            alert('Su Perfil a no se ha podido editar');
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


function fetchList(){
    $.ajax({
        url: '../Personas/php/task-list-all.php',
        type: 'GET',
        success: function(response){
            let task = JSON.parse(response);
            let template = '';
            task.forEach(tasks =>{
                    template +=`
                        <tr taskId="${tasks.dni}">
                        <td>
                            <a  class = "btn btn-ligth btnEditarPaciente btn-md rounded-pill" data-toggle="modal" data-target="#myModalEditarPaciente"> <i class="fas fa-edit fa-2x text-primary" title = "Editar"></i> </a>
                            </td>
                            <td class="align-center">${tasks.dni}</td>
                            <td>${tasks.nombre}</td>
                            <td>${tasks.telefono}</td>
                            <td>${tasks.email}</td>
                            <td>${tasks.genero}</td>
                        </tr>
                    `
                });
                $('#contenidoPaciente').html(template);
            }
    });
}
