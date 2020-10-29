<?php 

	include_once 'funcs/Connection.php';

    $id = $_POST['id'];
    $pagado = isset($_POST['pagado']) ? $_POST['pagado'] : 0;
	
	
	
	
	
    
		$sql_update = "UPDATE pmtfacturas SET pagado='$pagado' WHERE id=$id";
		$gsent = $pdo->prepare($sql_update);
		$gsent->execute();
		
		
		
    


//    $sql = "UPDATE pmtfacturas SET nfactura = $nfactura', fechafactura = '$fechafactura', rut = '$rut', nombre = '$nombre', facturapdf = '$facturapdf', aprobada = '$aprobada', nombre_obra = '$nombre_obra', direccion_obra = '$direccion_obra', mandante = '$mandante', nombre_admin = 'nombre_admin'  WHERE id = '$id'";
        
  //  $resultado = $mysqli->query($sql);


    if($gsent){
    echo "<script>
                alert('Factura Actualizada!');
                window.location= 'facturas2.php'
    </script>";
    } else {
            echo "<script>
                alert('Error al Actualizar');
    </script>";
    }
    

?>
