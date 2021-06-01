fetchList();

$('#searchCita').keyup(function(){
    if(($('#searchCita').val()) !== ""){
        let search = $('#searchCliente').val();
        $.ajax({
            url: '../Citas/php/task-search.php',
            type: 'POST',
            data: {search},
            success: function(response){
                let task = JSON.parse(response);
                console.log('task');
                let template = '';
                task.forEach(tasks =>{
                    template +=`
                        <tr taskId="${tasks.id}">
                        <td>
                        <a  class = "btn btn-ligth btnCitar btn-md rounded-pill" data-toggle="modal" data-target="#myModalAtender"> <i class="fas fa-headset fa-2x text-primary" title = "Atender"></i> </a>
                        </td>
                            <td class="align-center">${tasks.fecha}</td>
                            <td>${tasks.doctor}</td>
                            <td>${tasks.disponible}</td>
                        </tr>
                    `
                });
                $('#cotenidoCitas').html(template);
            }
        })
    } else {
        fetchList();
    }
});



$('#form-solicitarCita').submit(function(e) {
    const postData = {
        name: $('#nameRegister').val(),
    };
    $.post('../Cliente/php/task-add-cita.php', postData, function(response){
        window.location.href = '../Paciente/Citas/';   
    });
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


$(document).on('click','.btnVer', function(){
    let element = $(this)[0].parentElement.parentElement;
    let id = $(element).attr('taskId');
    console.log(id);
    $.post('../Cliente/php/task-view-cliente.php', {id}, function(response){
        const task = JSON.parse(response);
        $('#clienteView').html(task.name);
        $('#emailView').val(task.email);
        $('#telefonoView').val(task.phone);
        $('#celularView').val(task.movil);
        $('#direccionView').val(task.address);
        $('#posicionView').val(task.position);
        $('#distritoView').val(task.district);
        $('#provinciaView').val(task.province);
    });
    $.post('../Cliente/php/task-view-empresa.php', {id}, function(e){
        const task_business = JSON.parse(e);
        $('#razonSocialView').html(task_business.nameEmpresa);
        $('#rucView').val(task_business.ruc);
        $('#rubroView').val(task_business.rubro);
        $('#websiteView').val(task_business.page_web);
        $('#direccionEmpresaView').val(task_business.direccionEmpresa);
        $('#referenciaView').val(task_business.direccionEmpresaReference);
        $('#dateView').val(task_business.aniversario);
    });
    $.post('../Cliente/php/task-view-cliente-perfil.php',{id},function(response){
        const task_customer = JSON.parse(response);
        $('#dataTipoCliente').val(task_customer.type);
        $('#dataPoliticaCliente').val(task_customer.politic);
        $('#datacheckJob').val(task_customer.jobs);
        $('#dataFacturacionCliente').val(task_customer.facture);
        $('#dataPagosCliente').val(task_customer.frequency);
        $('#datosAdicionales').val(task_customer.special);
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

$(document).on('click','.btnAtender',function(){
    let element = $(this)[0].parentElement.parentElement;
    let id = $(element).attr('taskId');
    $.post('../Cliente/php/task-view-atencion.php', {id}, function(response){
        const task = JSON.parse(response);
        $('#clienteName').html(task.nombre);
        $('#empresaName').html(task.empresas);
        $('#idAtender').val(task.id);
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
    $.post('../Cliente/php/task-view-user.php',function(response){
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
    $.post('../Cliente/php/task-update-user.php',postData, function(response){
        alert('Su Perfil a sido editado');
    });
});

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
                            <a  class = "btn btn-ligth btnAtender btn-md rounded-pill" data-toggle="modal" data-target="#myModalAtender"> <i class="fas fa-headset fa-2x text-primary" title = "Atender"></i> </a>
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
        url: '../Paciente/php/task-list-all.php',
        type: 'GET',
        success: function(response){
            let task = JSON.parse(response);
            let template = '';
            task.forEach(tasks =>{
                    template +=`
                        <tr taskId="${tasks.id}">
                        <td>
                            <a  class = "btn btn-ligth btnAtender btn-md rounded-pill" data-toggle="modal" data-target="#myModalAtender"> <i class="fas fa-headset fa-2x text-primary" title = "Atender"></i> </a>
                            </td>
                            <td>${tasks.fecha}</td>
                            <td>${tasks.doctor}</td>
                            <td>${tasks.disponible}</td>
                        </tr>
                    `
                });
                $('#cotenidoCitas').html(template);
            }
    });
}

function fetchUser(){
    $.ajax({
        url: '../Paciente/php/task-search-user.php',
        type: 'GET',
        success: function(response){
            const task = JSON.parse(response);
            $('#userName').html(task.name);
            $('#userNameTwo').html(task.name);
            $('#userType').html(task.type);
        }
    });
}