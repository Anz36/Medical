<?php

    include '../../../Conexion/conexion.php';
    
    if(isset($_POST['personaDNI'])){
        $dni = $_POST['personaDNI'];
        $clave = $_POST['claveSecretaA'];
        $confirm = $_POST['claveSecretaConfirmarA'];
        
        $query = "SELECT * FROM users WHERE `name` = '$dni'";
        $result = $conexion->query($query);
        if ($result){
            $cont = $result->num_rows;
            if ($cont > 0){
                echo 'Ya se registro.';
            } else {
                if($clave == $confirm){
                    $claveencrip = sha1($clave);
                    $query = "INSERT INTO users(`name`,`password`,`type`)
                    VALUES ('$dni','$claveencrip','A')";
        
                    $result = $conexion->query($query);
                    if ($result){
                        echo 'Add';
                    } else {
                        echo 'Faild';
                    }
                } else {
                    echo 'Clave Incorrecta';
                }   
            }
        }     
    }
?>