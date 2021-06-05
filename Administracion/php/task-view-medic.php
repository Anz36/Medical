<?php
include "../../Conexion/conexion.php";
function getDoctor($dato){
    include "../../Conexion/conexion.php";
    $query = "SELECT * FROM doctors WHERE doctor_id = '$dato'";
    $result = $conexion->query($query)->fetch_array();
    return $result['name'];
}
function getDoctorEspecialidad($dato){
    include "../../Conexion/conexion.php";
    $query = "SELECT * FROM doctors WHERE doctor_id = '$dato'";
    $result = $conexion->query($query)->fetch_array();
    return $result['speciality'];
}
    $id = $_POST['id'];
    $query = "SELECT * FROM datings WHERE active!= 0 AND dating_id = '$id'";
    $result = $conexion->query($query);
    $json = array();
    while ($row = $result->fetch_array()){
        $json[] = array(
            'fecha' => $row['created_at'],
            'doctor' => getDoctor($row['doctor_id']),
            'especialidad' => getDoctorEspecialidad($row['doctor_id']),
            'id' => $row['dating_id']
        );
    }
    echo json_encode($json[0]);
?>