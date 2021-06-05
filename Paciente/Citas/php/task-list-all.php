<?php
    include "../../../Conexion/conexion.php";
    function getFecha($dato){
        include "../../../Conexion/conexion.php";
        $query = "SELECT * FROM datings WHERE  dating_id = '$dato' AND active != 0";
        $result = $conexion->query($query)->fetch_array();
        return $result['created_at'];
    }
    session_start();
    $idPaciente = $_SESSION['usuario'];
    $query = "SELECT * FROM medical_appointments WHERE pacient_id = '$idPaciente' AND active != 0";
    $result = $conexion->query($query);
    $json = array();
    while ($row = $result->fetch_array()) {
        $json [] = array(
            'idCita' => $row['datings_id'],
            'fechaCita' => getFecha($row['datings_id']),
            'id' => $row['medical_id']
        );
    }
    echo json_encode($json);
?>