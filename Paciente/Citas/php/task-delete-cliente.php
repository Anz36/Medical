<?php
    include '../../Conexion/conexion.php';

    if(isset($_POST['id'])){

        $id = $_POST['id'];
        $query = "UPDATE customers SET active = 0 WHERE id = '$id'";

        $result = $conexion->query($query);
        if($result){
            echo "Customer Deleted";
        } else {
            echo "Customer Failed function";
        }
    }
    
    

?>