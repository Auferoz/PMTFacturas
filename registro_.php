<?php 
    
require 'funcs/conexion.php';
require 'funcs/funcs.php';

    $errors = array();

    if (!empty($_POST))
    {
        $nombre = $mysqli->real_escape_string($_POST['nombre']);
        $usuario = $mysqli->real_escape_string($_POST['usuario']);
        $password = $mysqli->real_escape_string($_POST['password']);
        $con_password = $mysqli->real_escape_string($_POST['con_password']);
        $email = $mysqli->real_escape_string($_POST['email']);
		$captcha = $mysqli->real_escape_string($_POST['g-recaptcha-response']);
        
        $id_tipo = $mysqli->real_escape_string($_POST['id_tipo']);
        
		$activo = 0;
		$tipo_usuario = $id_tipo;
		$secret = '6LdvUbwUAAAAAJe6_sz4WLYvGLowTTSJ8FqDh0T9';//Modificar
        
        if(!$captcha){
            $errors[] = "Por favor verifica el captcha";
        }
        
        if (isNull($nombre, $usuario, $password, $con_password, $email)){
            $errors[] = "Debe llenar todo los campos";
        }
        
        if (!isEmail($email)){
            $errors[] = "Direción de correo inválida";
        }
        
        if (!ValidaPassword($password, $con_password)){
            $errors[] = "Las contraseñas no coinciden";
        }
        
        if (usuarioExiste($usuario)){
            $errors[] = "El nombre de usuario $usuario ya existe";
        }
        
        if (emailExiste($email)){
            $errors[] = "El correo electronico $email ya existe";
        }
        
        if (count($errors) == 0)
        {
        
            $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");
          //  var_dump($response);

            $arr = json_decode($response, TRUE);

            if($arr['success']){
                
                $pass_hash = hashPassword($password);
                $token = generateToken();
                
                $registro = registraUsuario($usuario, $pass_hash, $nombre, $email, $activo, $token, $tipo_usuario);
                
                if($registro >0 ){
                    
                    $url = 'http://'.$_SERVER["SERVER_NAME"].'/9 PROYECTO FACTURAS PMT/activar.php?id='.$registro.'&val='.$token;
                    
                    $asunto = 'Activar Cuenta - PMT Facturas de Compra';
                    $cuerpo = "Estimado $nombre: <br /><br />Para continuar con el proceso de registro, verificar en el siguiente enlace <a href='$url'>Activar Cuenta</a>";
                    
                    if (enviarEmail($email, $nombre, $asunto, $cuerpo)){
                        
                        echo "Para terminar el proceso de registro siga las instrucciones que le hemos enviado a la direccion de correo electronico: $email";
                        
                        echo"<br><br><a href='index.php'>Iniciar Sesion</a>";
                        exit;
                        
                    } else {
                        $errors[] = "Error al enviar Email";
                    }
                    
                } else {
                    $errors[] = "Error al Registrar";
                }

            }else{
               $errors[] = 'Error al comprobat Captcha';
            }
            
            
        }
        
        
    }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>PMT.CL | PROYECTO REGISTRO</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>

    <!-- Start your project here-->

    <section>
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-xs-12 col-md-5 my-4">
                    <!-- Default form register -->
                    <form id="signupform" class="form-horizontal text-center border border-light p-5" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">

                        <p class="h4 mb-4">PMT Registro</p>
                        <div id="signupalert" style="display:none" class="alert alert-danger">
                            <p>Error:</p>
                            <span></span>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="nombre" placeholder="Nombre" value="<?php if(isset($nombre)) echo $nombre; ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="usuario" placeholder="Usuario" value="<?php if(isset($usuario)) echo $usuario; ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="password" class="form-control" name="password" placeholder="Contraseña" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="password" class="form-control" name="con_password" placeholder="Confirmar Contraseña" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="email" class="form-control" name="email" placeholder="Correo Electronico" value="<?php if(isset($email)) echo $email; ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="aprobada" class="col-sm-12 control-label">¿Nivel de Usuario?</label>
                            <div class="col-xs-12 col-md-12">
                                <!-- Default inline 1-->
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="id_tipo1" name="id_tipo" value="2">
                                    <label class="custom-control-label" for="id_tipo1">Administrador</label>
                                </div>

                                <!-- Default inline 2-->
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="id_tipo2" name="id_tipo" value="3">
                                    <label class="custom-control-label" for="id_tipo2">Usuario</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="captcha" class="col-md-3 control-label"></label>
                            <div class="g-recaptcha col-md-9" data-sitekey="6LdvUbwUAAAAAD2zKbk1cmUBSkB5IK6R0hjpGZvf"></div>
                        </div>
                        <!-- Sign in button -->
                        <button class="btn btn-info btn-block my-4" type="submit">Registrar</button>
                        <!-- Register -->
                        <p>Si ya tienes cuenta
                            <a href="index.php">Iniciar Sesion</a>
                        </p>
                    </form>
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