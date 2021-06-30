<?php
    session_start();
    include "../../../Conexion/conexion.php";
    if (isset($_POST['id'])){
        $dni = $_POST['id'];
        $nombre = $_POST['nombre'];
        $genero = $_POST['genero'];
        $nacimiento = $_POST['nacimiento'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];

        $query = "UPDATE pacients SET `name`='$nombre', gender='$genero', email='$email', phone='$telefono', birthdate = '$nacimiento' WHERE pacient_id = '$dni'";
        $result = $conexion->query($query);
        if ($result){
            echo 'Update';
        } else {
            echo 'Faild';
        }
    }
?>