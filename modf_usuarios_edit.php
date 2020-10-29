<?php 

	include_once 'funcs/Connection.php';
	
	$id = $_GET['id'];
	$id_tipo = $_GET['id_tipo'];
    $nombre = $_GET['nombre'];
    $correo = $_GET['correo'];
    $usuario = $_GET['usuario'];
	
	$sql_editar = 'UPDATE usuarios SET id_tipo=?, nombre=?, correo=?, usuario=? WHERE id=?';
	$sentencia_editar = $pdo->prepare($sql_editar);
	$sentencia_editar->execute(array($id_tipo,$nombre,$correo,$usuario,$id));

    header('location:index.php');
?>