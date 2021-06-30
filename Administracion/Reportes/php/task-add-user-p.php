<?php

    include '../../../Conexion/conexion.php';
    
    if(isset($_POST['pacienteDNI'])){
        $dni = $_POST['pacienteDNI'];
        $clave = $_POST['claveSecreta'];
        $confirm = $_POST['claveSecretaConfirmar'];
        
        $query = "SELECT * FROM users WHERE `name` = '$dni'";
        $result = $conexion->query($query);
        if ($result){
            $cont = $result->num_rows;
            if ($cont > 0){
                echo 'Ya se registro.';
            } else {
                if($clave == $confirm){
                    $claveencrip = sha1($clave);
                    $query = "INSERT INTO users(`name`,`password`)
                    VALUES ('$dni','$claveencrip')";
        
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