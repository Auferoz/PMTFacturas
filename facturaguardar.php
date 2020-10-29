<?php 
    include_once 'funcs/Connection.php';

    $nfactura = $_POST['nfactura'];
    $fechafactura = $_POST['fechafactura'];
    $fechaingreso = $_POST['fechaingreso'];
    $rut = $_POST['rut'];
    $nombre = $_POST['nombre'];
    $aprobada = isset($_POST['aprobada']) ? $_POST['aprobada'] : 0;
    $nombre_admin = $_POST['nombre_admin'];
    $monto_iva = $_POST['monto_iva'];
    
    //$imagen PDF
    $facturapdf = $_FILES["facturapdf"]["name"];
    $ruta = $_FILES["facturapdf"]["tmp_name"];
    $destino = "img/Facturas/".$facturapdf;
    copy($ruta,$destino);


    $query = 'INSERT INTO pmtfacturas (nfactura,fechafactura,fechaingreso,rut,nombre,aprobada,nombre_admin,monto_iva,facturapdf) VALUES (?,?,?,?,?,?,?,?,?)';
    $sentencia_agregar = $pdo->prepare($query);

    if( $sentencia_agregar->execute(array($nfactura,$fechafactura,$fechaingreso,$rut,$nombre,$aprobada,$nombre_admin,$monto_iva,$facturapdf))  ){
    echo "<script>
                alert('Factura Agregada!');
                window.location= 'index.php'
    </script>";
    } else {
            echo "<script>
                alert('Error al agregar');
                window.location= 'index.php'
    </script>";
    }

 
    $sentencia_agregar = null;
    $pdo = null;

?>