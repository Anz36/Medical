

$('#register-form-empresa').submit(function(e){
    const postData = {
        razonSocial: $('#razonSocialRegister').val(),
        ruc: $('#rucRegister').val(),
        rubro: $('#rubroRegister').val(),
        website: $('#websiteRegister').val(),
        direccion: $('#direccionRegisterEmpresa').val(),
        referencia: $('#referenciaRegister').val(),
        aniversarios: $('#dateRegister').val()
    };
    $.post('../Cliente/php/task-add-empresa.php', postData, function(response){
        fetchCliente();
        $('#register-form-empresa').trigger('reset');
    });
});

function fetchCliente(){
    $.ajax({
        url: '../Cliente/php/task-list-all.php',
        type: 'GET',
        success: function(response){
            let task = JSON.parse(response);
            let template = '';
            task.forEach(tasks =>{
                template +=`
                    <tr taskId="${tasks.id}">
                    <td>
                    <a  class = "btn-ligth btnAtender btn-md rounded-pill" data-toggle="modal" data-target="#myModalAtender"> <i class="fas fa-headset fa-2x text-primary" title = "Atender"></i> </a>
                    <a  class = "btn-ligth btnVer btn-md rounded-pill" data-toggle="modal" data-target="#myModalVer"> <i class="fas fa-search-plus fa-2x text-primary" title="Visualizar Datos"></i>  </a> 
                    <a  class = "btn-ligth btnEditar btn-md rounded-pill" data-toggle="modal" data-target="#myModalEditar"> <i class="far fa-edit fa-2x text-primary" title="Editar"></i>  </a>
                    <a  class = "btn-ligth btn-md btnEliminar rounded-pill"> <i class="fas fa-trash fa-2x text-primary" title="Eliminar"></i>  </a>
                    </td>
                        <td>${tasks.id}</td>
                        <td>${tasks.cliente}</td>
                        <td>${tasks.empresa}</td>
                    </tr>
                `
            });
            $('#cotenidoCliente').html(template);
        }
    });
}