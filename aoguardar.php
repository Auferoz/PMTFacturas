<?php 
    
    require 'funcs/conexion.php';

    $ao_nombre = $_POST['ao_nombre'];

    $sql = "INSERT INTO admin_obra (ao_nombre) VALUES ('$ao_nombre')";
        
    $resultado = $mysqli->query($sql);

    if($resultado){
    echo "<script>
                alert('Admin de Obra Agregado!');
                window.location= 'index.php'
    </script>";
    } else {
            echo "<script>
                alert('Error al agregar');
    </script>";
    }

?>