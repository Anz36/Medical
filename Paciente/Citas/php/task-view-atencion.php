<?php

    function getBusiness($dato){
        if($dato == null){
            return "Sin dato";
        } else {
            include "../../Conexion/conexion.php";
            $query = "SELECT * FROM business WHERE id = '$dato'";
            $result = $conexion->query($query)->fetch_array();
            return $result['name'];
        }
        
    }

    include "../../Conexion/conexion.php";
    $id = $_POST['id'];
    $query = "SELECT * FROM customers WHERE id = '$id'";
    $result = $conexion->query($query);
    $json = array();
    while ($row = $result->fetch_array()){
        $json[] = array(
            'nombre' => $row['name'],
            'empresas' => getBusiness($row['id_business']),
            'id' => $row['id']
        );
    }
    echo json_encode($json[0]);
?>