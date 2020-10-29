<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $RUT = htmlspecialchars(trim($_POST["rut"]));
 
    // Codigo para buscar en tu base de datos acá
    

    require 'conexion.php';
    
    $sqlsi = "SELECT nombre_proveedor FROM proveedores WHERE rut_proveedor = '$RUT'";
    $resultado = $mysqli->query($sqlsi);
	$dato = $resultado->fetch_assoc();

    
    $nombre = $dato['nombre_proveedor'];
    echo $nombre;
 
} else {
    echo "<p>No se encontro el nombre en la DB!!</p>";
}
?>