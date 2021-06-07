<?php
    include "../../Conexion/conexion.php";

    $search = $_POST['search'];
    if(!empty($search)){
        $query = "SELECT datings.dating_id, doctors.name, datings.lot, datings.created_at FROM datings 
        INNER JOIN doctors ON datings.doctor_id = doctors.doctor_id WHERE datings.created_at LIKE '$search%' ";
        $result = $conexion->query($query);
        $json = array();
        while($row = $result->fetch_array()){
            $json[] = array(
            'doctor' => $row['name'],
            'fecha' => $row['created_at'],
            'disponible' => $row['lot'],
            'id' => $row['dating_id']
            );
        }
        echo json_encode($json);
    }
?>