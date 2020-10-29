<?php 

	include_once 'funcs/Connection.php';
	
	$id_ot = $_GET['id_ot'];
	$ot_nombre_obra = $_GET['ot_nombre_obra'];
    $ot_direccion_obra = $_GET['ot_direccion_obra'];
    $ot_mandante = $_GET['ot_mandante'];
	
	$sql_editar = 'UPDATE orden_de_trabajo SET id_ot=?, ot_nombre_obra=?, ot_direccion_obra=?, ot_mandante=? WHERE id_ot=?';
	$sentencia_editar = $pdo->prepare($sql_editar);
	$sentencia_editar->execute(array($id_ot,$ot_nombre_obra,$ot_direccion_obra,$ot_mandante,$id_ot));

    header('location:index.php');
?>