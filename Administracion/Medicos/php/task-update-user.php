<?php
    session_start();
    include "../../Conexion/conexion.php";
    $idUsuario = $_SESSION['usuario'];
    if (isset($_POST['dni'])){
        $dni = $_POST['dni'];
        $nombre = $_POST['nombre'];
        $genero = $_POST['genero'];
        $nacimiento = $_POST['nacimiento'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];

        $query = "UPDATE pacients SET `name`='$nombre', gender='$genero', email='$email', phone='$telefono', birthdate = '$nacimiento' WHERE pacient_id = '$idUsuario'";
        $result = $conexion->query($query);
        if ($result){
            echo 'Update';
        } else {
            echo 'Faild';
        }
    }
?>