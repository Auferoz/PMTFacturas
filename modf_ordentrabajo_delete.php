<?php
	

	include_once 'funcs/Connection.php';
 
	$id_ot = $_GET['id_ot'];
	
	$sql_eliminar = "DELETE FROM orden_de_trabajo WHERE id_ot = '$id_ot'";
	$sentencia_eliminar = $pdo->prepare($sql_eliminar);
	$sentencia_eliminar->execute(array($id_ot));
	
	//header('location:index.php');
	
?>
 
<html lang="es">
	<head>
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-theme.css" rel="stylesheet">
		<script src="js/jquery-3.1.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>	
	</head>
	
	<body>
		<div class="container">
			<div class="row">
				<div class="row" style="text-align:center">
				<?php if($sentencia_eliminar) { ?>
				<h3>REGISTRO ELIMINADO</h3>
				<?php } else { ?>
				<h3>ERROR AL ELIMINAR</h3>
				<?php } ?>
				
				<a href="index.php" class="btn btn-primary">Regresar</a>
				
				</div>
			</div>
		</div>
	</body>
</html>