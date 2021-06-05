<?php
    include "../../../Conexion/conexion.php";
    session_start();
    $idPaciente = $_SESSION['usuario'];
    $search = $_POST['search'];
    if(!empty($search)){
        $query = "SELECT medical_appointments.pacient_id, medical_appointments.datings_id, datings.created_at FROM medical_appointments 
        INNER JOIN datings ON medical_appointments.datings_id = datings.dating_id 
        WHERE datings.created_at LIKE '$search%' AND medical_appointments.pacient_id = '$idPaciente' 
        AND datings.active != 0 AND medical_appointments.active != 0";
        $result = $conexion->query($query);
        $json = array();
        while($row = $result->fetch_array()){
            $json[] = array(
            'idCita' => $row['datings_id'],
            'fechaCita' => $row['created_at']
            );
        }
        echo json_encode($json);
    }
?>