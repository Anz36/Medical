fetchList();

$('#searchMedico').keyup(function(){
    if(($('#searchMedico').val()) !== ""){
        let search = $('#searchMedico').val();
        $.ajax({
            url: '../Medicos/php/task-search.php',
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
                            <a  class = "btn btn-ligth btnEditarMedico btn-md rounded-pill" data-toggle="modal" data-target="#myModalEditar"> <i class="fas fa-edit fa-2x text-primary" title = "Editar"></i> </a>
                            </td>
                            <td class="align-center">${tasks.nombre}</td>
                            <td>${tasks.email}</td>
                            <td>${tasks.telefono}</td>
                            <td>${tasks.genero}</td>
                            <td>${tasks.especialidad}</td>
                        </tr>
                    `
                });
                $('#contenidoMedico').html(template);
            }
        })
    } else {
        fetchList();
    }
});



$('#form-add-medico').submit(function(e) {
    const postData = {
        medicoNombre: $('#medicoNombre').val(),
        medicoEmail: $('#medicoEmail').val(),
        medicoTelefono: $('#medicoTelefono').val(),
        medicoEspecialidad: $('#medicoEspecialidad').val(),
        medicoGenero: $('#medicoGenero').val()
    };
    $.post('../Medicos/php/task-add-medic.php', postData, function(response){
        console.log(response);
        if(response === 'Add'){
            $('#form-add-medico').trigger('reset');
            alert('Se agrego Medico');
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


$(document).on('click','.btnEditarMedico',function(){
    let element = $(this)[0].parentElement.parentElement;
    let id = $(element).attr('taskId');
    $.post('../Medicos/php/task-view-medic.php', {id}, function(response){
        const task = JSON.parse(response);
        $('#nombreMedico').val(task.nombre);
        $('#emailMedico').val(task.email);
        $('#telefonoMedico').val(task.telefono);
        $('#especialidadMedico').val(task.especilidad);
        $('#generoMedico').val(task.genero);
        $('#idMedico').val(task.id);
    });
});

$('#form-edit-medico').submit(function(e){
    const postData = {
        id: $('#idMedico').val(),
        nombre: $('#nombreMedico').val(),
        genero: $('#generoMedico').val(),
        especialidad: $('#especialidadMedico').val(),
        telefono: $('#telefonoMedico').val(),
        email: $('#emailMedico').val()
    }
    console.log(postData);
    $.post('../Medicos/php/task-update-medico.php',postData, function(response){
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
        url: '../Medicos/php/task-list-all.php',
        type: 'GET',
        success: function(response){
            let task = JSON.parse(response);
            let template = '';
            task.forEach(tasks =>{
                    template +=`
                        <tr taskId="${tasks.id}">
                        <td>
                            <a  class = "btn btn-ligth btnEditarMedico btn-md rounded-pill" data-toggle="modal" data-target="#myModalEditarMedico"> <i class="fas fa-edit fa-2x text-primary" title = "Editar"></i> </a>
                            </td>
                            <td class="align-center">${tasks.nombre}</td>
                            <td>${tasks.email}</td>
                            <td>${tasks.telefono}</td>
                            <td>${tasks.genero}</td>
                            <td>${tasks.especialidad}</td>
                        </tr>
                    `
                });
                $('#contenidoMedico').html(template);
            }
    });
}
