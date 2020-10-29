<?php 

	include_once 'funcs/Connection.php';

    $id = $_POST['id'];
    $nfactura = $_POST['nfactura'];
    $fechafactura = $_POST['fechafactura'];
    $rut = $_POST['rut'];
    $nombre = $_POST['nombre'];
    $monto_iva = $_POST['monto_iva'];
    $aprobada = isset($_POST['aprobada']) ? $_POST['aprobada'] : 0;
	
	
    $nombre_obra = $_POST['nombre_obra'];
    $direccion_obra = $_POST['direccion_obra'];
    $mandante = $_POST['mandante'];
    $nombre_admin = $_POST['nombre_admin'];
    $detalle = $_POST['detalle'];
    
    $nombreuser = $_POST['nombreuser'];
    $fechaeditada = $_POST['fechaeditada'];
	
	
	
	
	
    
		$sql_update = "UPDATE pmtfacturas SET nfactura='$nfactura' WHERE id=$id";
		$gsent = $pdo->prepare($sql_update);
		$gsent->execute();
		
		
		$sql_update = "UPDATE pmtfacturas SET fechafactura='$fechafactura' WHERE id=$id";
		$gsent = $pdo->prepare($sql_update);
		$gsent->execute();
		
		
		$sql_update = "UPDATE pmtfacturas SET rut='$rut' WHERE id=$id";
		$gsent = $pdo->prepare($sql_update);
		$gsent->execute();
		
		
		$sql_update = "UPDATE pmtfacturas SET nombre='$nombre' WHERE id=$id";
		$gsent = $pdo->prepare($sql_update);
		$gsent->execute();
		
		
		$sql_update = "UPDATE pmtfacturas SET monto_iva='$monto_iva' WHERE id=$id";
		$gsent = $pdo->prepare($sql_update);
		$gsent->execute();
		
		
		$sql_update = "UPDATE pmtfacturas SET aprobada='$aprobada' WHERE id=$id";
		$gsent = $pdo->prepare($sql_update);
		$gsent->execute();
		
		
		$sql_update = "UPDATE pmtfacturas SET nombre_obra='$nombre_obra' WHERE id=$id";
		$gsent = $pdo->prepare($sql_update);
		$gsent->execute();
		
		
		$sql_update = "UPDATE pmtfacturas SET direccion_obra='$direccion_obra' WHERE id=$id";
		$gsent = $pdo->prepare($sql_update);
		$gsent->execute();
		
		
		$sql_update = "UPDATE pmtfacturas SET mandante='$mandante' WHERE id=$id";
		$gsent = $pdo->prepare($sql_update);
		$gsent->execute();
		
		
		$sql_update = "UPDATE pmtfacturas SET nombre_admin='$nombre_admin' WHERE id=$id";
		$gsent = $pdo->prepare($sql_update);
		$gsent->execute();
		
		
		$sql_update = "UPDATE pmtfacturas SET detalle='$detalle' WHERE id=$id";
		$gsent = $pdo->prepare($sql_update);
		$gsent->execute();
		
		
		$sql_update = "UPDATE pmtfacturas SET nombreuser='$nombreuser' WHERE id=$id";
		$gsent = $pdo->prepare($sql_update);
		$gsent->execute();
		
		
		$sql_update = "UPDATE pmtfacturas SET fechaeditada='$fechaeditada' WHERE id=$id";
		$gsent = $pdo->prepare($sql_update);
		$gsent->execute();
		
		
		
        $facturanc = $_FILES["facturanc"]["name"];
        $rutapdf = $_FILES["facturanc"]["tmp_name"];
        $destinopdf = "img/Nota_Credito/".$facturanc;
        
    
		$sql_update = "UPDATE pmtfacturas SET facturanc='$facturanc' WHERE id=$id";
		
			if (empty($facturanc)) 
		{
		    
		}
		else{
		    
            copy($rutapdf,$destinopdf);
			$gsent2 = $pdo->prepare($sql_update);
			$gsent2->execute();
		}
		
		
		
        $facturaoc = $_FILES["facturaoc"]["name"];
        $rutapdf = $_FILES["facturaoc"]["tmp_name"];
        $destinopdf = "img/Orden_Compra/".$facturaoc;
        
    
		$sql_update = "UPDATE pmtfacturas SET facturaoc='$facturaoc' WHERE id=$id";
		
			if (empty($facturaoc)) 
		{
		    
		}
		else{
		    
            copy($rutapdf,$destinopdf);
			$gsent2 = $pdo->prepare($sql_update);
			$gsent2->execute();
		}
		
		
    


//    $sql = "UPDATE pmtfacturas SET nfactura = $nfactura', fechafactura = '$fechafactura', rut = '$rut', nombre = '$nombre', facturapdf = '$facturapdf', aprobada = '$aprobada', nombre_obra = '$nombre_obra', direccion_obra = '$direccion_obra', mandante = '$mandante', nombre_admin = 'nombre_admin'  WHERE id = '$id'";
        
  //  $resultado = $mysqli->query($sql);


    if($gsent){
    echo "<script>
                alert('Factura Actualizada!');
                window.location= 'index.php'
    </script>";
    } else {
            echo "<script>
                alert('Error al Actualizar');
    </script>";
    }
    

?>
