<?php
        session_start();
        include "../../../Conexion/conexion.php";
        function getDato($dato){
            if($dato == 'P'){
                return 'Paciente';
            } else {
                return 'Administracion';
            }
        }
        $idUsuario = $_SESSION['usuario'];
        $type_user = $_SESSION['type'];
        $query = "SELECT * FROM pacients WHERE pacient_id = '$idUsuario'";
        $result = $conexion->query($query);
        $json = array();
        while($row = $result->fetch_array()){
            $json[] = array(
                'name' => $row['name'],
                'type' => getDato($type_user)
            );
        }
        $jsonstring = json_encode($json[0]);
        echo $jsonstring;
?>