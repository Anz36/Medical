<?php
    include '../../Conexion/conexion.php';
    
    if (isset($_POST['ruc'])){
        $name = $_POST['razonSocial'];
        $ruc = $_POST['ruc'];
        $rubro = $_POST['rubro'];
        $direccion = $_POST['direccion'];
        $refenrecia = $_POST['referencia'];
        $website = $_POST['website'];
        $anivresarios = $_POST['aniversarios'];
        
        $query = "INSERT INTO business(`name`, ruc, rubro, `address`, reference, anniversary, `page`) 
        VALUES ('$name', '$ruc', '$rubro', '$direccion', '$refenrecia', '$anivresarios', '$website')";

        $result = $conexion->query($query);

        if($result){
            echo "Add Business";
        } else {
            echo "Failed add business";
        }
    }
    

?>