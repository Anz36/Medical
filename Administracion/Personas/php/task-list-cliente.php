<?php

    function getNull($dato){
        include "../../Conexion/conexion.php";
        if($dato == null){
            return "Sin Dato";
        }else {
            $query = "SELECT `name` FROM business WHERE id = '$dato'";
            $result = $conexion->query($query)->fetch_array();
            return $result['name'];
        }
    }

    include "../../Conexion/conexion.php";
    $limit = $_POST['limit'];
    if($limit == '25'){
        $query = "SELECT * FROM customers ORDER BY id DESC LIMIT 25";
        $result = $conexion->query($query);
        $json = array();
        while ($row = $result->fetch_array()){
            $json[] = array(
                'id' => $row['id'],
                'cliente' => $row['name'],
                'empresa' => getNull($row['id_business']),
                'limit' => $limit
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    } else {
        if($limit == '50'){
            $query = "SELECT * FROM customers WHERE active!= 0 ORDER BY id DESC LIMIT 50";
            $result = $conexion->query($query);
            $json = array();
            while ($row = $result->fetch_array()){
                $json[] = array(
                    'id' => $row['id'],
                    'cliente' => $row['name'],
                    'empresa' => getNull($row['id_business']),
                    'limit' => $limit
                );
            }
            $jsonstring = json_encode($json);
            echo $jsonstring;
        } else {
            if($limit == '100'){
                $query = "SELECT * FROM customers WHERE active!= 0 ORDER BY id DESC LIMIT 100";
                $result = $conexion->query($query);
                $json = array();
                while ($row = $result->fetch_array()){
                    $json[] = array(
                        'id' => $row['id'],
                        'cliente' => $row['name'],
                        'empresa' => getNull($row['id_business']),
                        'limit' => $limit
                    );
                }
                $jsonstring = json_encode($json);
                echo $jsonstring;
            }else {
                if($limit == '200'){
                    $query = "SELECT * FROM customers WHERE active!= 0 ORDER BY id DESC LIMIT 200";
                    $result = $conexion->query($query);
                    $json = array();
                    while ($row = $result->fetch_array()){
                        $json[] = array(
                            'id' => $row['id'],
                            'cliente' => $row['name'],
                            'empresa' => getNull($row['id_business']),
                            'limit' => $limit
                        );
                    }
                    $jsonstring = json_encode($json);
                    echo $jsonstring;
                } else {
                    $query = "SELECT * FROM customers WHERE active!= 0 ORDER BY id DESC ";
                    $result = $conexion->query($query);
                    $json = array();
                    while ($row = $result->fetch_array()){
                        $json[] = array(
                            'id' => $row['id'],
                            'cliente' => $row['name'],
                            'empresa' => getNull($row['id_business']),
                            'limit' => $limit
                        );
                    }
                    $jsonstring = json_encode($json);
                    echo $jsonstring;
                }
            }
        }
        
    }
    

?>