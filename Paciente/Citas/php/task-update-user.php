<?php
    session_start();
    include "../../Conexion/conexion.php";
    $idUsuario = $_SESSION['usuario'];
    if (isset($_POST['nombre'])){
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $cumpleaños = $_POST['cumpleaños'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];

        $query = "UPDATE people SET `name`='$nombre', last_name='$apellidos', email='$email', phone='$telefono' WHERE id = '$idUsuario'";
        $result = $conexion->query($query);
        if ($result){
            echo 'Update';
        } else {
            echo 'Faild';
        }
    }
?>