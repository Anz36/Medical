<?php
    include "../../Conexion/conexion.php";
    $id = $_POST['id'];
    $query = "SELECT * FROM customers WHERE id = '$id'";
    $result = $conexion->query($query);
    $json = array();
    while ($row = $result->fetch_array()){
        $json[] = array(
            'name' => $row['name'],
            'position' => $row['position'],
            'address' => $row['address'],
            'district' => $row['district'],
            'province' => $row['province'],
            'email' => $row['email'],
            'phone' => $row['phone'],
            'id' => $row['id']
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
?>