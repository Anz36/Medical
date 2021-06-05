<?php
    function getLot($dato){
        include "../../Conexion/conexion.php";
        $query = "SELECT * FROM datings WHERE dating_id = '$dato' AND active != 0";
        $result = $conexion->query($query)->fetch_array();
        return $result['lot'];
    }
    include "../../Conexion/conexion.php";
    session_start();
    $idPaciente = $_SESSION['usuario'];
    $idCita = $_POST['id'];
    $lot = getLot($idCita);
    $query = "SELECT * FROM medical_appointments WHERE pacient_id = '$idPaciente' AND datings_id = '$idCita' AND active !=0";
    $result = $conexion->query($query);
    if($result){
        $cont = $result->num_rows;
        if($cont > 0){
            echo 'Double cite';
        } else {
            if($lot !== 0){
                $query = "INSERT INTO medical_appointments (pacient_id, datings_id ) VALUES ('$idPaciente','$idCita')";
                $result = $conexion->query($query);
                if($result){
                    $lot = $lot-1;
                    $query = "UPDATE datings SET lot = '$lot' WHERE dating_id = '$idCita' AND active != 0";
                    $result = $conexion->query($query);
                    if($result){
                        echo 'Success';
                    }
                }
            } else {
            echo 'Fail';
        }
        }
    }
    
    
    
?>