<?php
    include "../../../Conexion/conexion.php";

    $search = $_POST['search'];
    if(!empty($search)){
        $query = "SELECT * FROM pacients WHERE `name` LIKE '%$search%' OR pacient_id LIKE '%$search%' AND active != 0";
        $result = $conexion->query($query);
        $json = array();
        while($row = $result->fetch_array()){
            $json[] = array(
                'nombre' => $row['name'],
                'email' => $row['email'],
                'telefono' => $row['phone'],
                'genero' => $row['gender'],
                'dni' => $row['pacient_id']
            );
        }
        echo json_encode($json);
    }
?>