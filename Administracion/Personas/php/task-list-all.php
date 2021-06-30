<?php
include "../../../Conexion/conexion.php";

    $query = "SELECT * FROM pacients WHERE active!= 0 ORDER BY created_at DESC LIMIT 25";
    $result = $conexion->query($query);
    $json = array();
    while ($row = $result->fetch_array()){
        $json[] = array(
            'nombre' => $row['name'],
            'email' => $row['email'],
            'telefono' => $row['phone'],
            'genero' => $row['gender'],
            'dni' => $row['pacient_id']
        );
    }
    echo json_encode($json);
?>