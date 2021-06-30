<?php
include "../../../Conexion/conexion.php";

    $query = "SELECT * FROM users WHERE active!= 0 ORDER BY created_at DESC LIMIT 25";
    $result = $conexion->query($query);
    $json = array();
    while ($row = $result->fetch_array()){
        $json[] = array(
            'usuario' => $row['name'],
            'tipo' => $row['type'],
            'id' => $row['users_id']
        );
    }
    echo json_encode($json);
?>