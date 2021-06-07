<?php
    include "../../../Conexion/conexion.php";

    $search = $_POST['search'];
    if(!empty($search)){
        $query = "SELECT * FROM pacients WHERE `name` LIKE '%$search%' AND active != 0";
        $result = $conexion->query($query);
        $json = array();
        while($row = $result->fetch_array()){
            $json[] = array(
                'dni' => $row['pacient_id'],
                'nombre' => $row['name'],
                'telefono' => $row['phone'],
                'genero' => $row['gender'],
                'id' => $row['pacient_id']
            );
        }
        echo json_encode($json);
    }
?>