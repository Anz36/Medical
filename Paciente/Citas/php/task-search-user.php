<?php
        session_start();
        include "../../Conexion/conexion.php";
        $idUsuario = $_SESSION['usuario'];
        $type_user = $_SESSION['type'];
        $query = "SELECT * FROM people WHERE id = '$idUsuario'";
        $result = $conexion->query($query);
        $json = array();
        while($row = $result->fetch_array()){
            $json[] = array(
                'name' => $row['name']." ".$row['last_name'],
                'type' => $type_user
            );
        }
        $jsonstring = json_encode($json[0]);
        echo $jsonstring;
?>