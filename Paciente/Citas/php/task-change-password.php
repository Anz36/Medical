<?php
    include "../../../Conexion/conexion.php";
    session_start();
    $idUsuario = $_SESSION['usuario'];
    if(isset($_POST['palabraActual'])){
        $actual = $_POST['palabraActual'];
        $actual = sha1($actual);
        $cambiar = $_POST['palabraNueva'];
        $cambiar = sha1($cambiar);
        $query = "SELECT * FROM users WHERE `name` = '$idUsuario'";
        $result = $conexion->query($query)->fetch_array();
        $passwordActual = $result['password'];
        if($actual == $passwordActual){
            $query = "UPDATE users SET `password` = '$cambiar' WHERE `name` = '$idUsuario'";
            $result = $conexion->query($query);
            if($result){
                echo 'Change Password';
            } else {
                echo 'Fail change password';
            }
        }
        
    }
?>