<?php
    include "../../Conexion/conexion.php";
    $query = "SELECT * FROM business ORDER BY id DESC";
    $result = $conexion->query($query);
    $json = array();
    while ($row = $result->fetch_array()){
        if($row['name'] != null){
            $json[] = array(
                'id' => $row['id'],
                'empresa' => $row['name']
            );
        }
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
?>