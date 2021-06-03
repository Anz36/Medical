
$('#pacienteDNI').keyup(function(){
    let dato = $('#pacienteDNI').val();
    $.ajax({
        url: '../Registro/php/task-dni.php',
        type: 'POST',
        data: {dato},
        success: function(response){
            console.log(response);
        }
    });
});