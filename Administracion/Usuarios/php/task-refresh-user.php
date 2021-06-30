<?php
    include "../../../Conexion/conexion.php";
    $usuario = $_POST['id'];
    $query = "UPDATE users SET `password` = '7ff9b6994582b6c0d8b1cbc58562a1a6f6c8411b' WHERE `users_id` = '$usuario'";
    $result = $conexion->query($query);
    if ($result){
        echo 'Refresh';
    } else {
        echo 'Faild';
    }
?>