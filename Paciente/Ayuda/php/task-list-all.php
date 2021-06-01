<?php
function getNull($dato){
    include "../../Conexion/conexion.php";
    if($dato == null){
        return "Sin Dato";
    }else {
        $query = "SELECT `name` FROM business WHERE id = '$dato'";
        $result = $conexion->query($query)->fetch_array();
        return $result['name'];
    }
}

include "../../Conexion/conexion.php";
    $query = "SELECT * FROM customers WHERE active!= 0 ORDER BY id DESC LIMIT 25";
    $result = $conexion->query($query);
    $json = array();
    while ($row = $result->fetch_array()){
        $json[] = array(
            'id' => $row['id'],
            'cliente' => $row['name'],
            'empresa' => getNull($row['id_business']),
            'posicion' => $row['position'],
            'direccion' => $row['address'],
            'distrito' => $row['district'],
            'provincia' => $row['province'],
            'email' => $row['email'],
            'telefono' => $row['phone']
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
?>