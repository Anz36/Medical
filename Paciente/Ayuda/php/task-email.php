<?php 
    session_start();
    function getNombre($data) {
        include '../../../Conexion/conexion.php';
        $query = "SELECT * FROM pacients WHERE pacient_id = '$data'";
        $result = $conexion->query($query)->fetch_array();
        return $result['name'];
    }
    function getTelefono($data) {
        include '../../../Conexion/conexion.php';
        $query = "SELECT * FROM pacients WHERE pacient_id = '$data'";
        $result = $conexion->query($query)->fetch_array();
        return $result['phone'];
    }
    function getEmail($data) {
        include '../../../Conexion/conexion.php';
        $query = "SELECT * FROM pacients WHERE pacient_id = '$data'";
        $result = $conexion->query($query)->fetch_array();
        return $result['email'];
    }
    
    $usuario = $_SESSION['usuario'];
	if (isset($_POST["asuntoEmail"])) {	
		require "../../../Librerias/Mailer/PHPMailer.php";
		require "../../../Librerias/Mailer/Exception.php";
		require "../../../Librerias/Mailer/SMTP.php";

	   	#$ruta = "upload/".$_FILES['archivo']['name'];
	    #move_uploaded_file($_FILES['archivo']['tmp_name'],$ruta);

		$mail = new PHPMailer\PHPMailer\PHPMailer;
		$mail->SMTPDebug = 0;
		$mail->isSMTP();
		$mail->Host='mail.patronatogastronomicodelperu.com';
		$mail->Port= 465;
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'ssl';
		$mail->Username = 'informes@patronatogastronomicodelperu.com';
		$mail->Password = ',S=]}X?-A_WK';

		$mail->setFrom('informes@patronatogastronomicodelperu.com');
		$mail->addReplyTo('informes@patronatogastronomicodelperu.com');
		$mail->addAddress('Harool.Florez@gmail.com');

		$mail->isHTML(true);
		$mail->Subject = $_POST["asuntoEmail"];
		$mail->Body=
        "<h3>Este Mensaje ha sido enviado por:</h3><br>
        <h6>Nombres: <strong>".getNombre($usuario)."</strong></h6> <br>
        <h6>Telefono: <strong>".getTelefono($usuario)."</strong></h6> <br>
        <h6>Correo: <strong>".getEmail($usuario)."</strong></h6> <br>
        <h3>Mensaje: </h3> <br>
        <p>".$_POST['mensajeEmail']."</p>";
		#$mail->addAttachment($ruta);

		if (!$mail->send()) {
			echo "Faild";
		} else {
			echo "Send";
		}
	}
 ?>