<?php
    include '../../Conexion/conexion.php';
    if (isset($_POST['name'])){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
        $celular = $_POST['celular'];
        $direccion = $_POST['direccion'];
        $posicion = $_POST['posicion'];
        $distrito = $_POST['distrito'];
        $provincia = $_POST['provincia'];
        $empresa = $_POST['empresa'];

        $query = "UPDATE customers SET name='$name',position='$posicion',`address`='$direccion',district='$distrito',
        province='$provincia',email='$email',phone='$telefono', id_business='$empresa' WHERE id = '$id' ";
        $result = $conexion->query($query);
        if ($result){
            echo "Edit Success";
        } else {
            echo "Edit fail";
        }
    }
?>