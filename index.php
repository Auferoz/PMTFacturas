<?php 

    require 'funcs/conexion.php';
    require 'funcs/funcs.php';

	session_start(); //Iniciar una nueva sesión o reanudar la existente

    if(isset($_POST['recordar']) && !empty($_POST['recordar'])){
    setcookie("nombre_de_cookie", "valor_de_cookie", time()+3600, "/" , "localhost"); 
    }

	if(isset($_SESSION["id_usuario"])){ //En caso de existir la sesión redireccionamos
		header("Location: facturas.php");
	}

	$errors = array();

	if(!empty($_POST))
	{
		$usuario = $mysqli->real_escape_string($_POST['usuario']);
		$password = $mysqli->real_escape_string($_POST['password']);
		
		if(isNullLogin($usuario, $password))
		{
			$errors[] = "Debe llenar todos los campos";
		}

		$errors[] = login($usuario, $password);	
	}
?>

<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>PMT.CL | FACTURAS </title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">
    <link href="img/Logo_SVG_PMT.svg" rel="shortcut icon" />
</head>

<body>

    <!-- Start your project here-->

    <section class="LoginBack flex-center flex-column">
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-xs-12 col-md-5">
                    <!-- Default form login -->
                    <form id="loginform" class="form-horizontal text-center p-5" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="on">
                       
                        <div class="form-group d-flex justify-content-center align-items-center">
                            <div class="col-md-12 LoginLogo">
                                <img src="img/Logo_SVG_PMT.svg" alt="">
                                <h3>Aprobación de Facturas</h3>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 TextoLogin">
                                <!-- Email -->
                                <h6>Iniciar Sesión</h6>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <!-- Email -->
                                <input id="usuario" type="text" class="form-control mb-1" name="usuario" value="" placeholder="Usuario" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <!-- Password -->
                                <input id="password" type="password" class="form-control mb-4" name="password" placeholder="Password" required>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <div class="col-md-12">
                                <!-- Sign in button -->
                                <button class="btn btn-login" type="submit">Entrar</button>
                            </div>
                        </div>
						
						<!-- Register -->
						<p>Not a member?
							<a href="">Register</a>
						</p>
                        
                    </form>
                    <!-- Default form login -->
                    <?php echo resultBlock($errors); ?>
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

</html>