<?php 

	include_once 'funcs/Connection.php';
	
	$id_proveedor = $_GET['id_proveedor'];
	$nombre_proveedor = $_GET['nombre_proveedor'];
    $rut_proveedor = $_GET['rut_proveedor'];
	
	$sql_editar = 'UPDATE proveedores SET id_proveedor=?, nombre_proveedor=?, rut_proveedor=? WHERE id_proveedor=?';
	$sentencia_editar = $pdo->prepare($sql_editar);
	$sentencia_editar->execute(array($id_proveedor,$nombre_proveedor,$rut_proveedor,$id_proveedor));

    header('location:index.php');
?>