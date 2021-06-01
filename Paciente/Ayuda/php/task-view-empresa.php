<?php
    function getEmpresa($dato){
        include ("../../conexion/conexion.php");
        $query = "SELECT * FROM customers WHERE id = '$dato'";
        $result = $conexion->query($query)->fetch_array();
        return $result['id_business'];
    }

    $id = $_POST['id'];
    $idEmpresa = getEmpresa($id);

    include("../../conexion/conexion.php");
    
        $query = "SELECT * FROM business WHERE id = '$idEmpresa'";
        $result = $conexion->query($query);
        $json = array();
        while ($row = $result->fetch_array()){
            $json[] = array(
                'nameEmpresa' => $row['name'],
                'ruc' => $row['ruc'],
                'rubro' => $row['rubro'],
                'direccionEmpresa' => $row['address'],
                'direccionEmpresaReference' => $row['reference'],
                'aniversario' => $row['anniversary'],
                'page_web' => $row['page'],
                'id' => $row['id']
            );
        }
        $jsonstring = json_encode($json[0]);
        echo $jsonstring;
    
    

?>