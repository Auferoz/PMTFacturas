<?php 

	include_once 'Connection.php';

	$id_ao = $_POST["id_ao"];
	$ao_nombre = $_POST["ao_nombre"];

	$sql_update = "UPDATE admin_obra SET ao_nombre='$ao_nombre' WHERE id_ao=$id_ao";
	$gsend = $pdo->prepare($sql_update);
	$gsend->execute();

    echo "<script>
            alert('Actualizado!');
            window.location= '../index.php'
		  </script>";
?>