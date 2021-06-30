<?php
//AddPage(orientacion[PORTRAIT, LANDSCAPE], tamaño[A3, A4, A5, LETTER, LEGAL], rotacion(90, 180, 270, 360)),
//SetFont(tipo[COURIER, HELVETICA, ARIAL, TIMES, SYMBOL, ZAPDINGBATS], estilo[normal, B, I, U], tamaño),
//Cell(ancho, alto, texto, border, ?, alineacion, rellenar, link),
//OutPut(destino[I, D, F, S], nombre_archivo, utf8)
// $pdf->Image(ruta, posicionX, posicionY, alto, ancho, tipo, link);
require('../../../Librerias/fpdf/fpdf.php');
include('../../../Conexion/conexion.php');
session_start();

Class PDF extends FPDF{
	#Cabecera de la Pagina
	function Header(){
		//Times blod 12
		$this->SetFont('Times','B',10);
		$this->Cell(0,5,'Reporte de Citas',0,0,'');
		//Posición
		$this->SetX(-30);
		//$this->Write(5,'Compina');
		$this->Ln(20);
		
	}
	function Footer(){
	// Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Times italic 8
    $this->SetFont('Times','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
	}
}
$fecha = $_POST['fecha'];
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('PORTRAIT','A4');
include "funciones.php";
$name = $_SESSION['usuario'];
$name = getUsuario($name);

	#Sí el usuario esta logueado, mostrata los Datos Correspondientes.
	$pdf->SetFont('Times','B',15);
	#Titulo
	$pdf->Write(10,'Reporte de la Fecha '); $pdf->Write(10,$fecha);
	$pdf->Ln(10);
	#Subtitulos
	$pdf->SetFont('Times','B',11);
	$pdf->Write(10,'Reporte Hecho por : '); $pdf->Write(10,$name);

	#Salto de Linea
	$pdf->Ln(10);
	#Header de la Tabla
	$pdf->SetFontSize(12);
	#Color de Relleno
	$pdf->SetFillColor(255,255,255);
	#Color de Texto
	$pdf->SetTextColor(40,40,40);
	#Color del Borde de la tabla
	$pdf->SetDrawColor(40,40,40);
	$pdf->SetLineWidth(1);
	$pdf->write(10,'     ');
    $pdf->Cell(20,10,"Cita ID",0,0,'C',1);
	$pdf->Cell(35,10,"Doctor",0,0,'C',1);
	$pdf->Cell(35,10,"Disponibilidad",0,0,'C',1);
	$pdf->Cell(45,10,"fecha",0,0,'C',1);
	$pdf->SetDrawColor(33, 157, 159, 62);
	$pdf->Line(10.2,60,120,60);
	#Salto de Linea
	$pdf->Ln(12);
	#Datos de la Tabla
	$pdf->SetLineWidth(0.5);
	$pdf->SetFontSize(11.5);
	$pdf->SetTextColor(40,40,40);

	$query = "SELECT * FROM datings WHERE active!= 0 AND created_at LIKE '$fecha%'";
	$result = $conexion->query($query);
	while ($row = $result->fetch_array()){
		$pdf->Cell(20,10,$row['dating_id'],0,0,'C',0);
		$pdf->Cell(35,10,getDoctor($row['doctor_id']),0,0,'C',0);
		$pdf->Cell(35,10,$row['lot'],0,0,'C',0);
		$pdf->Cell(45,10,$row['created_at'],0,1,'C',0);
	}

$pdf->Output('F','../Documentos/Reporte_Citas_'.$fecha.'.pdf',);
echo $url = "../Reportes/Documentos/Reporte_Citas_".$fecha.".pdf";
?>