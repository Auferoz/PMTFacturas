<?php 

	include_once 'funcs/Connection.php';
	
	$id_ao = $_GET['id_ao'];
	$ao_nombre = $_GET['ao_nombre'];
	
	$sql_editar = 'UPDATE admin_obra SET id_ao=?, ao_nombre=? WHERE id_ao=?';
	$sentencia_editar = $pdo->prepare($sql_editar);
	$sentencia_editar->execute(array($id_ao,$ao_nombre,$id_ao));

    header('location:index.php');
?>