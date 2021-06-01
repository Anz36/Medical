<?php
	include "../../Conexion/conexion.php";
	function getData($dato){
		if($dato == 1){
			return 'Si';
		} else {
			return 'No';
		}
	}
	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$query = "SELECT * FROM customers_perfil WHERE id_customer = '$id'";
		$json = array();
		$result = $conexion->query($query);
		while ($row = $result->fetch_array()){
			$json[] = array(
				'type' => $row['type'],
				'politic' => $row['politic_payment'],
				'jobs' => getData($row['supplier_job']),
				'facture' => $row['facture'],
				'frequency' => $row['frequency_payment'],
				'special' => $row['special_text']
			);
		}
		echo json_encode($json[0]);
	}
?>