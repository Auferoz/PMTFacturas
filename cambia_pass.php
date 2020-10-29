<?php
	require 'funcs/conexion.php';
	include 'funcs/funcs.php';
	session_start();
	
	if(empty($_GET['user_id'])){
		header('Location: index.php');
	}
	
	if(empty($_GET['token'])){
		header('Location: index.php');
	}
	
	$user_id = $mysqli->real_escape_string($_GET['user_id']);
	$token = $mysqli->real_escape_string($_GET['token']);
	
	if(!verificaTokenPass($user_id, $token))
	{
		echo 'No se pudo verificar los Datos';
		exit;
	} 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>PMT.CL | PROYECTO LOGIN</title>
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
                    <!-- Default form login -->
                    <form id="loginform" class="form-horizontal text-center border border-light p-5" role="form" action="guarda_pass.php" method="POST" autocomplete="off">

                        <p class="h4 mb-4">Cambiar Contraseña</p>

                        <!-- Email -->
							
				        <input type="hidden" id="user_id" name="user_id" value ="<?php echo $user_id; ?>" />
				        <input type="hidden" id="token" name="token" value ="<?php echo $token; ?>" />
				        
				        <input type="password" class="form-control mb-4" name="password" placeholder="Nueva Contraseña" required>
                        <input type="password" class="form-control mb-4" name="con_password" placeholder="Confirmar Contraseña" required>

                        <!-- Sign in button -->
                        <button class="btn btn-info btn-block my-4" type="submit">Modificar Contraseña</button>
                        
                        <p>
						    <a href="index.php">Iniciar Sesi&oacute;n</a>!
                        </p>

                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Start your project here-->

    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
</body>		