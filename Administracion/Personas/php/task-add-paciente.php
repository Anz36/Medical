<?php

    include '../../../Conexion/conexion.php';

    if(isset($_POST['pacienteNombre'])){
        $pacienteNombre = $_POST['pacienteNombre'];
        $pacienteEmail = $_POST['pacienteEmail'];
        $pacienteTelefono = $_POST['pacienteTelefono'];
        $pacienteNacimiento = $_POST['pacienteNacimiento'];
        $pacienteGenero = $_POST['pacienteGenero'];
        $pacienteDNI = $_POST['pacienteDni'];

        $query = "INSERT INTO pacients(`name`,email,phone,gender,birthdate,pacient_id)
        VALUES ('$pacienteNombre','$pacienteEmail','$pacienteTelefono','$pacienteGenero','$pacienteNacimiento','$pacienteDNI')";

        $result = $conexion->query($query);
        if ($result){
            echo 'Add';
        } else {
            echo 'Faild';
        }
            
    }
?>