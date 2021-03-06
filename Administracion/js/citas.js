fetchList();
fetchDoctor();

$('#searchCita').change(function(){
    if(($('#searchCita').val()) !== ""){
        let search = $('#searchCita').val();
        $.ajax({
            url: '../Administracion/php/task-search.php',
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
                        <a  class = "btn btn-ligth btnSolicitar btn-md rounded-pill" data-toggle="modal" data-target="#myModalAtender"> <i class="fas fa-headset fa-2x text-primary" title = "Atender"></i> </a>
                        </td>
                            <td class="align-center">${tasks.fecha}</td>
                            <td>${tasks.doctor}</td>
                            <td>${tasks.disponible}</td>
                        </tr>
                    `
                });
                $('#cotenidoCita').html(template);
            }
        })
    } else {
        fetchList();
    }
});



$('#form-add-cite').submit(function(e) {
    const postData = {
        fechaCita: $('#fechaCita').val(),
        horaCita: $('#horaCita').val(),
        lotCita: $('#lotCita').val(),
        medicoCita: $('#medicoCita').val(),
    };
    $.post('../Administracion/php/task-add-cita.php', postData, function(response){
        if(response === 'Add Cite'){
            $('#form-add-cite').trigger('reset');
            alert('Se agrego una Cita');
            fetchList();
        } else {
            alert('Verifica los datos');
        }
    });
    e.preventDefault();
});

$(document).on('click','.btnCerrarSession', function(){
    $.ajax({
        url: '../Paciente/php/task-logout.php',
        type: 'GET',
        success: function(response){
            window.location.href = '../Login/';
        }
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
    $.post('../Cliente/php/task-edit-cliente.php', postData, function(response){
        fetchList();
    });
    e.preventDefault();
});

$(document).on('click','.btnSolicitar',function(){
    let element = $(this)[0].parentElement.parentElement;
    let id = $(element).attr('taskId');
    $.post('../Paciente/php/task-view-medic.php', {id}, function(response){
        const task = JSON.parse(response);
        $('#nombreMedico').val(task.doctor);
        $('#fechaCita').val(task.fecha);
        $('#especialidadMedico').val(task.especialidad);
        $('#idCitaMedica').val(task.id);
    });
});

$('#form-atencion').submit(function(e){
    const postData = {
        id: $('#idAtender').val(),
        type: $('#selectType').val(),
        origin: $('#selectOrigin').val(),
        status: $('#selectStatus').val()
    };
    $.post('../Cliente/php/task-add-atention.php', postData, function(response){
        window.location.href = "../Atencion/"
    });
});

$(document).on('click','.btnPerfil',function(){
    $.post('../Paciente/php/task-view-user.php',function(response){
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
    $.post('../Paciente/php/task-update-user.php',postData, function(response){
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
    $.post('../Paciente/php/task-change-password.php',postData, function(response){
        if(response === 'Change Password'){
            alert('Su contrase??a se ha cambiado');
        }else {
            alert('No se ha podido cambiar, revise su contrase??a');
        }
    });
    e.preventDefault();
});
function fetchDoctor(){
    $.ajax({
        url: '../Administracion/php/task-list-medic.php',
        type: 'GET',
        success: function(response){
            let task = JSON.parse(response);
            let template = '';
            task.forEach(tasks =>{
                template +=`
                <option value="${tasks.id}">${tasks.name}</option>
                `
            });
            $('#medicoCita').html(template);
        }
    });
}
function fetchCliente(){
    
    $('#mostrarDatos').change(function(){
        if ($('#mostrarDatos').val() !== ''){
            let limit = $('#mostrarDatos').val();
            $.ajax({
                url: '../Cliente/php/task-list-cliente.php',
                type: 'POST',
                data: {limit},
                success: function(response){
                    let task = JSON.parse(response);
                    let template = '';
                    task.forEach(tasks =>{
                        template +=`
                        <tr taskId="${tasks.id}">
                        <td>
                            <a  class = "btn btn-ligth btnSolicitar btn-md rounded-pill" data-toggle="modal" data-target="#myModalAtender"> <i class="fas fa-headset fa-2x text-primary" title = "Atender"></i> </a>
                            </td>
                            <td>${tasks.fecha}</td>
                            <td>${tasks.doctor}</td>
                            <td>${tasks.disponible}</td>
                        </tr>
                        `
                    });
                    $('#cotenidoCliente').html(template);
                }
            });
        }
    });
    
}

function fetchList(){
    $.ajax({
        url: '../Administracion/php/task-list-all.php',
        type: 'GET',
        success: function(response){
            let task = JSON.parse(response);
            let template = '';
            task.forEach(tasks =>{
                    template +=`
                        <tr taskId="${tasks.id}">
                        <td>
                            <a  class = "btn btn-ligth btnSolicitar btn-md rounded-pill" data-toggle="modal" data-target="#myModalSolicitar"> <i class="fas fa-headset fa-2x text-primary" title = "Atender"></i> </a>
                            </td>
                            <td>${tasks.fecha}</td>
                            <td>${tasks.doctor}</td>
                            <td>${tasks.disponible}</td>
                        </tr>
                    `
                });
                $('#cotenidoCita').html(template);
            }
    });
}
