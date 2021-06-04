<?php
    include "../../Conexion/conexion.php";
    session_start();
        $usuario = $_POST['usuarioIngreso'];
        $claveSecreta = $_POST['usuarioClave'];
        $claveEncript = sha1($claveSecreta);
        $query = "SELECT * FROM users WHERE name = '$usuario' AND password = '$claveEncript' AND active = 1 ";
        
        $result = $conexion->query($query);
        if ($result){
            $_SESSION['usuario'] = $usuario;
            while ($row = $result->fetch_array()){
                $type = $row['type'];
            }
            $_SESSION['type'] = $type;
            if ($type == 'P'){
                header ('Location: ../../Paciente/');
            } else {
                header ('Location: ../../Administracion/');
            }
        }
            
        
    
?>