<?php
    include "../../Conexion/conexion.php";
    function getNull($dato){
        include "../../Conexion/conexion.php";
        if($dato == null){
            return "Sin Dato";
        }else {
            $query = "SELECT name FROM business WHERE id = '$dato'";
            $result = $conexion->query($query)->fetch_array();
            return $result['name'];
        }
    }

    function getEmpresa($dato){
            include "../../Conexion/conexion.php";
            $query = "SELECT id FROM business WHERE name like '$dato%'";
            $result = $conexion->query($query)->fetch_array();
            return $result['id'];
    }

    $search = $_POST['search'];
    if(!empty($search)){
        $query = "SELECT * from customers where `name` like '$search%' or email like '$search%' or phone like '$search%' or district like '$search%' or position like '$search%' ORDER BY id DESC";
        $result = $conexion->query($query);
        $json = array();
        while($row = $result->fetch_array()){
            $json[] = array(
            'id' => $row['id'],
            'cliente' => $row['name'],
            'business' => getNull($row['id_business'])
            );
        }
        $jsonString = json_encode($json);
        if($jsonString == "[]"){
            $idEmpresa = getEmpresa($search);
            $query = "SELECT * from customers WHERE business = '$idEmpresa'";
            $result = $conexion->query($query);
            $json = array();
            while($row = $result->fetch_array()){
                $json[] = array(
                    'id' => $row['id'],
                    'cliente' => $row['name'],
                    'business' => getNull($row['id_business'])
                    );
            }
            $jsonString = json_encode($json);
            echo $jsonString;
        } else {
            echo $jsonString;
        }
        
    }
?>