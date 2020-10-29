<?php 
    
    require 'funcs/conexion.php';

    $nombre_proveedor = $_POST['nombre_proveedor'];
    $rut_proveedor = $_POST['rut_proveedor'];

    $sql = "INSERT INTO proveedores (nombre_proveedor, rut_proveedor) VALUES ('$nombre_proveedor', '$rut_proveedor')";
        
    $resultado = $mysqli->query($sql);

    if($resultado){
    echo "<script>
                alert('Proveedor Agregado!');
                window.location= 'index.php'
    </script>";
    } else {
            echo "<script>
                alert('Error al agregar');
    </script>";
    }

?>