<?php
    include "../../../Conexion/conexion.php";

    $search = $_POST['search'];
    if(!empty($search)){
        $query = "SELECT * FROM users WHERE `name` LIKE '%$search%' AND active != 0";
        $result = $conexion->query($query);
        $json = array();
        while($row = $result->fetch_array()){
            $json[] = array(
                'usuario' => $row['name'],
                'tipo' => $row['type'],
                'id' => $row['users_id']
            );
        }
        echo json_encode($json);
    }
?>