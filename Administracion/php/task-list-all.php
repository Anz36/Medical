<?php
include "../../Conexion/conexion.php";
function getDoctor($dato){
    include "../../Conexion/conexion.php";
    $query = "SELECT * FROM doctors WHERE doctor_id = '$dato'";
    $result = $conexion->query($query)->fetch_array();
    return $result['name'];
}
    $query = "SELECT * FROM datings WHERE active!= 0 ORDER BY dating_id DESC LIMIT 25";
    $result = $conexion->query($query);
    $json = array();
    while ($row = $result->fetch_array()){
        $json[] = array(
            'fecha' => $row['created_at'],
            'doctor' => getDoctor($row['doctor_id']),
            'disponible' => $row['lot'],
            'id' => $row['dating_id']
        );
    }
    echo json_encode($json);
?>