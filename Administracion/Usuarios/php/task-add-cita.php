<?php
    include "../../Conexion/conexion.php";

    if(isset($_POST['fechaCita'])){
        $fechaCita = $_POST['fechaCita'].' '.$_POST['horaCita'];
        $lotCita = $_POST['lotCita'];
        $medicoCita = $_POST['medicoCita'];
        if($lotCita == null){
            $query = "INSERT INTO datings (created_at, doctor_id) VALUES ('$fechaCita','$medicoCita')";
            $result = $conexion->query($query);
            if ($result){
                echo 'Add Cite';
            } else {
                echo 'Faild';
            }
        } else {
            $query = "INSERT INTO datings (created_at, doctor_id, lot) VALUES ('$fechaCita','$medicoCita','$lotCita')";
            $result = $conexion->query($query);
            if ($result){
                echo 'Add Cite';
            } else {
                echo 'Faild';
            }
        }
    }
    
    
    
?>