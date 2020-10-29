<?php 
    
require 'funcs/conexion.php';
require 'funcs/funcs.php';

if(isset($_GET["id"]) AND isset($_GET['val']))
{
    $idUsuario = $_GET['id'];
    $token = $_GET['val'];
    
    $mensaje = validaIdToken($idUsuario, $token);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>PMT.CL | USUARIO ACTIVO</title>
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
    <div class="container">
        <div class="jumbotron">
            <h1><?php echo $mensaje; ?></h1>
            <br />
            <p><a class="btn btn-primary btn-lg" href="index.php" role="button"> Iniciar Sesión </a></p>
        </div>
    </div>

</body>

</html>

<!-- Start your project here-->

<section>