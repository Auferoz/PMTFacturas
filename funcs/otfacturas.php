<?php
 
 
	$servername = "localhost";
	$username = "pmtcl_master";
	$password = "ucGYsXs.g*BZ";
	$db 	  = "pmtcl_db";
 
 
	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $db);
 
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}else{
		//echo "Connected successfully";
		//error_log('TESTING');
	}
 
 
	if(isset($_POST['option'])){
		if($_POST['option']=='obtener_rut'){
			ot_nombre_obra();
		}
	}
 
	function ot_nombre_obra(){
		global $conn;
 
		$ot_nombre_obra = $_POST['ot_nombre_obra'];
		$query = "SELECT ot_direccion_obra, ot_mandante FROM orden_de_trabajo WHERE ot_nombre_obra = '$ot_nombre_obra'";
		$r=mysqli_query($conn,$query);
		$n = mysqli_num_rows($r);
		if($n>0){
			$resultado = mysqli_fetch_array($r);
			$ot_direccion_obra = $resultado['ot_direccion_obra'];
			$ot_mandante = $resultado['ot_mandante'];
			$respuesta = '';
		}else{
			$respuesta = 'No existe el ot_nombre_obra!';
		}
 
		$jsondata['respuesta'] = $respuesta;
		$jsondata['ot_direccion_obra'] = $ot_direccion_obra;
		$jsondata['ot_mandante'] = $ot_mandante;
		echo json_encode($jsondata);
	}
?>