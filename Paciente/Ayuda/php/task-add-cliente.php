<?php
     include "../../Conexion/conexion.php";
     function getIdCliente(){
        include '../../Conexion/conexion.php';
        $query = "SELECT * FROM customers ORDER BY created_at DESC LIMIT 1";
        $result = $conexion->query($query)->fetch_array();
        return $result['id'];
    }

     if (isset($_POST['name'])){
         $name = $_POST['name'];
         $email = $_POST['email'];
         $telefono = $_POST['telefono'];
         $direccion = $_POST['direccion'];
         $posicion = $_POST['posicion'];
         $distrito = $_POST['distrito'];
         $provincia = $_POST['provincia'];
         $empresa = $_POST['empresa'];

         $query = "INSERT INTO customers(`name`, position, `address`, district, province, email, phone, id_business) 
         VALUES ('$name', '$posicion', '$direccion', '$distrito', '$provincia', '$email', '$telefono', '$empresa')";

         $result = $conexion->query($query);
         if ($result){
            $idCliente = getIdCliente();

            $type = $_POST['type'];
            $politica = $_POST['politic'];
            $factura = $_POST['factures'];
            $pagos = $_POST['play'];
            $adicional = $_POST['adicion'];
            $jobs = $_POST['check'];
            if($jobs == true){
                $jobs = 1;
            } else {
                $jobs = 0;
            }
            $query = "INSERT INTO customers_perfil(id_customer, `type`, `politic_payment`, supplier_job, facture, frequency_payment, special_text) 
            VALUES ('$idCliente', '$type', '$politica', '$jobs', '$factura', '$pagos', '$adicional')";
            
            $result = $conexion->query($query);
            if ($result){
                echo "Task Add";
            } else {
                echo "Task Faild";
            }
         } else {
             echo "Task Faild";
         }
     }
?>