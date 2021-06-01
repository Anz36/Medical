<?php
    include "../../Conexion/conexion.php";
    if(isset($_POST['pacienteDNI'])){
        $pacienteDNI = $_POST['pacienteDNI'];
        $pacienteNombre = $_POST['pacienteNombre'];
        $pacienteEmail = $_POST['pacienteEmail'];
        $pacienteGenero = $_POST['pacienteGenero'];
        $pacienteTelefono = $_POST['pacienteTelefono'];
        $pacienteNacimiento = $_POST['pacienteNacimiento'];
        $contraseñaPaciente = $_POST['contraseñaPaciente'];
        $contraseñaEcript = sha1($contraseñaPaciente)
        $query = "INSERT INTO pacients(name, email, phone, birthdate, gender) 
        VALUES ('$pacienteNombre','$pacienteEmail','$pacienteTelefono','$pacienteNacimiento','$pacienteGenero')";
        $result = $conexion->query($query);
        if ($result){
            $query = "INSERT INTO users(name,password) VALUES ('$pacienteDNI','$contraseñaEcript')";
            $result = $conexion->query($query);
            if ($result){
                echo 'Add Pacient';
            } else {
                echo 'Fail in User Pacient';
            }
        } else {
            echo 'Fail Pacient Add';
        }

    }
?>