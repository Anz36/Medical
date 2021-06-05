
    fetchList();   
$('#searchCite').change(function(){    
    if(($('#searchCite').val()) !== ""){
        let search = $('#searchCite').val();
        $.ajax({
            url: '../Citas/php/task-search.php',
            type: 'POST',
            data: {search},
            success: function(response){
                let task = JSON.parse(response);
                let template = '';
                task.forEach(tasks =>{
                    template +=`
                        <tr taskId="${tasks.id}">
                        <td>
                        <a  class = "btn btn-ligth btnSolicitar btn-md rounded-pill" data-toggle="modal" data-target="#myModalAtender"> <i class="fas fa-headset fa-2x text-primary" title = "Atender"></i> </a>
                        </td>
                            <td class="align-center">${tasks.idCita}</td>
                            <td>${tasks.fechaCita}</td>
                        </tr>
                    `
                });
                $('#cotenidoMisCitas').html(template);
            }
        })
    } else {
        fetchList();
    }
});
function fetchList(){
    $.ajax({
        url: '../Citas/php/task-list-all.php',
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
                            <td>${tasks.idCita}</td>
                            <td>${tasks.fechaCita}</td>
                        </tr>
                    `
                });
                $('#cotenidoMisCitas').html(template);
            }
    });
}
$(document).on('click','.btnCerrarSession', function(){
    $.ajax({
        url: '../Citas/php/task-logout.php',
        type: 'GET',
        success: function(response){
            window.location.href = '../../Login/';
        }
    });
});

function fetchEmpresa(){
    $.ajax({
        url: '../Cliente/php/task-list-empresa.php',
        type: 'GET',
        success: function(response){
            let task = JSON.parse(response);
            let template = '';
            task.forEach(tasks =>{
                template +=`
                    <option value="${tasks.id}">${tasks.empresa}</option>
                `
            });
            $('#datoEmpresaRegister').html(template);
            $('#datoEmpresaAll').html(template);
        }
    });
}
