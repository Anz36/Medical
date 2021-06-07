fetchUser();
function fetchUser(){
    $.ajax({
        url: '../Usuarios/php/task-search-user.php',
        type: 'GET',
        success: function(response){
            const task = JSON.parse(response);
            $('#userName').html(task.name);
            $('#userNameTwo').html(task.name);
            $('#userType').html(task.type);
        }
    });
}