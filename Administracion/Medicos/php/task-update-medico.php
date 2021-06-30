<?php
    session_start();
    include "../../../Conexion/conexion.php";
    $idUsuario = $_SESSION['usuario'];
    if (isset($_POST['id'])){
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $genero = $_POST['genero'];
        $especialidad = $_POST['especialidad'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];

        $query = "UPDATE doctors SET `name`='$nombre', gender='$genero', email='$email', phone='$telefono', speciality = '$especialidad' WHERE doctor_id = '$id'";
        $result = $conexion->query($query);
        if ($result){
            echo 'Update';
        } else {
            echo 'Faild';
        }
    }
?>