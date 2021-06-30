<?php
include "../../../Conexion/conexion.php";

    $id = $_POST['id'];
    $query = "SELECT * FROM pacients WHERE active!= 0 AND pacient_id = '$id'";
    $result = $conexion->query($query);
    $json = array();
    while ($row = $result->fetch_array()){
        $json[] = array(
            'nombre' => $row['name'],
            'email' => $row['email'],
            'telefono' => $row['phone'],
            'genero' => $row['gender'],
            'nacimiento' => $row['birthdate'],
            'dni' => $row['pacient_id']
        );
    }
    echo json_encode($json[0]);
?>