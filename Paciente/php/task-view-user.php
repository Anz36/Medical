<?php
    include '../../Conexion/conexion.php';
    session_start();
    function getClave($dato){
        include "../../Conexion/conexion.php";
        $query = "SELECT * FROM users WHERE name = '$dato'";
    }
    $idUsuario = $_SESSION['usuario'];
    $json = array();
    $query = "SELECT * FROM pacients WHERE pacient_id = '$idUsuario'";
    $result = $conexion->query($query);
    while ($row = $result->fetch_array()){
        $json[] = array(
            'nombre' => $row['name'],
            'dni' => $row['pacient_id'],
            'nacimiento' => $row['birthdate'],
            'email' => $row['email'],
            'telefono' => $row['phone'],
            'genero' => $row['gender']
        );
    }
    echo json_encode($json[0]);
?> 