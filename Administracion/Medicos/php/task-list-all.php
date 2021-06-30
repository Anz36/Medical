<?php
include "../../../Conexion/conexion.php";

    $query = "SELECT * FROM doctors WHERE active!= 0 ORDER BY doctor_id DESC LIMIT 25";
    $result = $conexion->query($query);
    $json = array();
    while ($row = $result->fetch_array()){
        $json[] = array(
            'nombre' => $row['name'],
            'email' => $row['email'],
            'telefono' => $row['phone'],
            'genero' => $row['gender'],
            'especialidad' => $row['speciality'],
            'id' => $row['doctor_id']
        );
    }
    echo json_encode($json);
?>