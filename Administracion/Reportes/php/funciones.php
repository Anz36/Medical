<?php

function getUsuario($dato){
	include('../../../Conexion/conexion.php');
	$query = "SELECT name FROM pacients WHERE pacient_id = '$dato'";
	$result = $conexion->query($query)->fetch_array();
    return $result['name'];
}

function getDoctor($dato){
	include('../../../Conexion/conexion.php');
	$query = "SELECT name FROM doctors WHERE doctor_id = '$dato'";
	$result = $conexion->query($query)->fetch_array();
    return $result['name'];
}

?>