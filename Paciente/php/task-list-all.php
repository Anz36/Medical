<?php
include "../../Conexion/conexion.php";
    $query = "SELECT * FROM datings WHERE active!= 0 ORDER BY id DESC LIMIT 25";
    $result = $conexion->query($query);
    $json = array();
    while ($row = $result->fetch_array()){
        $json[] = array(
            'fecha' => $row['created_at'],
            'doctor' => $row['doctor_id'],
            'disponible' => $row['lot']
        );
    }
    echo json_encode($json);
?>