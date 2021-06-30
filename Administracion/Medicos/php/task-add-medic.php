<?php

    include '../../../Conexion/conexion.php';

    if(isset($_POST['medicoNombre'])){
        $medicoNombre = $_POST['medicoNombre'];
        $medicoEmail = $_POST['medicoEmail'];
        $medicoTelefono = $_POST['medicoTelefono'];
        $medicoEspecialidad = $_POST['medicoEspecialidad'];
        $medicoGenero = $_POST['medicoGenero'];

        $query = "INSERT INTO doctors(`name`,email,phone,gender,speciality)
        VALUES ('$medicoNombre','$medicoEmail','$medicoTelefono','$medicoGenero','$medicoEspecialidad')";

        $result = $conexion->query($query);
        if ($result){
            echo 'Add';
        } else {
            echo 'Faild';
        }
            
    }
?>