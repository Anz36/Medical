<?php
    include '../../Conexion/conexion.php';
    session_start();
    $idUsuario = $_SESSION['usuario'];
    $json = array();
    $query = "SELECT * FROM people WHERE id = '$idUsuario'";
    $result = $conexion->query($query);
    while ($row = $result->fetch_array()){
        $json[] = array(
            'nombre' => $row['name'],
            'apellidos' => $row['last_name'],
            'cumpleaños' => $row['birthdate'],
            'email' => $row['email'],
            'telefono' => $row['phone']
        );
    }
    echo json_encode($json[0]);
?> 