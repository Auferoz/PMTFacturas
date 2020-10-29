<?php 
    
    require 'funcs/conexion.php';

    $ot_nombre_obra = $_POST['ot_nombre_obra'];
    $ot_direccion_obra = $_POST['ot_direccion_obra'];
    $ot_mandante = $_POST['ot_mandante'];

    $sql = "INSERT INTO orden_de_trabajo (ot_nombre_obra, ot_direccion_obra, ot_mandante) VALUES ('$ot_nombre_obra', '$ot_direccion_obra', '$ot_mandante')";
        
    $resultado = $mysqli->query($sql);

    if($resultado){
    echo "<script>
                alert('Orden de Trabajo Agregada!');
                window.location= 'index.php'
    </script>";
    } else {
            echo "<script>
                alert('Error al agregar');
    </script>";
    }

?>