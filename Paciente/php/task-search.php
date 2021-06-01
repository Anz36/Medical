<?php
    include "../../Conexion/conexion.php";

    $search = $_POST['search'];
    if(!empty($search)){
        $query = "SELECT * from datings where `doctor_id` like '$search%' or created_at like '$search%' ORDER BY dating_id DESC";
        $result = $conexion->query($query);
        $json = array();
        while($row = $result->fetch_array()){
            $json[] = array(
            'doctor' => $row['doctor_id'],
            'fecha' => $row['created_at'],
            'disponible' => $row['lot']
            );
        }
        echo json_encode($json);
    }
?>