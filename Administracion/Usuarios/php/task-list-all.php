<?php
include "../../../Conexion/conexion.php";

    $query = "SELECT * FROM pacients WHERE active!= 0 ORDER BY pacient_id DESC LIMIT 25";
    $result = $conexion->query($query);
    $json = array();
    while ($row = $result->fetch_array()){
        $json[] = array(
            'dni' => $row['pacient_id'],
            'nombre' => $row['name'],
            'telefono' => $row['phone'],
            'genero' => $row['gender'],
            'id' => $row['pacient_id']
        );
    }
    echo json_encode($json);
?>