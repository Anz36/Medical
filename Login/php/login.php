<?php
    include "../../Conexion/conexion.php";
    session_start();
    if(isset($_POST['submit'])){
        $usuario = $_POST['usuarioIngreso'];
        $claveSecreta = $_POST['usuarioClave'];

        $claveEncript = sha1($claveSecreta);
        $query = "SELECT * FROM users WHERE name = '$usuario' AND password = '$claveEncript' active = 1 ";
        $result = $conexion->query($query);
        if ($result){
            $result = fetch_array();
            $type = $result['type'];
            if ($type == 'P'){
                header(location: '../Paciente/');
            } else {
                header(location: '../Administracion/');
            }
        }
    }
?>