<?php
include "../../../Conexion/conexion.php";

    $id = $_POST['id'];
    $query = "SELECT * FROM doctors WHERE active!= 0 AND doctor_id = '$id'";
    $result = $conexion->query($query);
    $json = array();
    while ($row = $result->fetch_array()){
        $json[] = array(
            'nombre' => $row['name'],
            'email' => $row['email'],
            'telefono' => $row['phone'],
            'genero' => $row['gender'],
            'especilidad' => $row['speciality'],
            'id' => $row['doctor_id']
        );
    }
    echo json_encode($json[0]);
?>