<?php
    include "../../../Conexion/conexion.php";
    $query = "SELECT * FROM pacients WHERE active!= 0";
    $result = $conexion->query($query);
    $json = array();
    while ($row = $result->fetch_array()){
        $json[] = array(
            'name' => $row['name'],
            'id' => $row['pacient_id']
        );
    }
    echo json_encode($json);
?>