<?php 
    
require 'funcs/conexion.php';
require 'funcs/funcs.php';

 
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>PMT.CL | AGREGAR NUEVO PROVEEDOR</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

    <!-- Start your project here-->

    <section>
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-xs-12 col-md-5 my-4">
                    <!-- Default form register -->
                    <form class="form-horizontal border border-light p-5" method="POST" action="proveedorguardar.php" autocomplete="off">

                        <p class="h4 mb-4 text-center">AGREGAR PROVEEDOR</p>
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="nombre_proveedor" placeholder="Nombre del Proveedor:" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="rut_proveedor" placeholder="RUT Proveedor:" required>
                            </div>
                        </div>
                        <!-- Sign in button -->
                        <a href="index.php" class="btn btn-default ml-4">Regresar</a>
                        <button class="btn btn-info my-4" type="submit">AGREGAR</button>
                    </form>
                </div>
            </div>
        </div>
    </section>




    <!-- Start your project here-->

    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script>
        $custom - file - text: (
            en: "Browse",
            es: "Elegir"
        );
    </script>
    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
</body>

</html>