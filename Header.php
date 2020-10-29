<?php 
    
    session_start();
    require 'funcs/conexion.php';
    require 'funcs/funcs.php';

    if(!isset($_SESSION["id_usuario"])){ //Si no ha iniciado sesión redirecciona a index.php
		header("Location: index.php");
	}

    $idUsuario = $_SESSION['id_usuario'];
	
	$sqlu = "SELECT id, nombre FROM usuarios WHERE id = '$idUsuario'";
	$result = $mysqli->query($sqlu);
	$row = $result->fetch_assoc();


    $where = "";
    $sqldesc = "SELECT * FROM pmtfacturas ORDER BY id DESC";
    $resultado = $mysqli->query($sqldesc);


    $where = "";
    $sql_ap_uno = "SELECT * FROM pmtfacturas WHERE aprobada = '1' ORDER BY id DESC";
    $rsltd_uno = $mysqli->query($sql_ap_uno);


    $where = "";
    $sql_ap_dos = "SELECT * FROM pmtfacturas WHERE aprobada = '0' ORDER BY id DESC";
    $rsltd_dos = $mysqli->query($sql_ap_dos);


    $where = "";
    $sql_ap_tres = "SELECT * FROM pmtfacturas WHERE aprobada = '2' ORDER BY id DESC";
    $rsltd_tres = $mysqli->query($sql_ap_tres);
	
	
	$sqlsi = "SELECT COUNT(aprobada) as approvedsi FROM pmtfacturas where aprobada = '1'";
	$suma1 = $mysqli->query($sqlsi);
	$approvedsi = $suma1->fetch_assoc();
    $fact = $approvedsi['approvedsi'];
    
    	
	$sqlno = "SELECT COUNT(aprobada) as approvedno FROM pmtfacturas where aprobada = '0'";
	$suma0 = $mysqli->query($sqlno);
	$approvedno = $suma0->fetch_assoc();
    $fact = $approvedno['approvedno'];
    
    	
	$sqlre = "SELECT COUNT(aprobada) as rechazadas FROM pmtfacturas where aprobada = '2'";
	$suma2 = $mysqli->query($sqlre);
	$rechazadas = $suma2->fetch_assoc();
    $fact = $rechazadas['rechazadas'];
	
	
	
	
	include_once 'funcs/Connection.php';

	
	$sql_admin_obra = 'SELECT * FROM admin_obra';
	$gsent = $pdo->prepare($sql_admin_obra);
	$gsent->execute();
	$result_ao = $gsent->fetchAll();

	$sql_orden_trabajo = 'SELECT * FROM orden_de_trabajo';
	$gsent = $pdo->prepare($sql_orden_trabajo);
	$gsent->execute();
	$result_ot = $gsent->fetchAll();

	$sql_proveedor = 'SELECT * FROM proveedores';
	$gsent = $pdo->prepare($sql_proveedor);
	$gsent->execute();
	$result_prov = $gsent->fetchAll();


	$sql_fact = "SELECT nombre_proveedor FROM proveedores";
	$gsent = $pdo->prepare($sql_fact);
	$gsent->execute();
	$result_fact = $gsent->fetchAll();
	
	
	$sql_ao = "SELECT * FROM admin_obra";
	$gsent3 = $pdo->prepare($sql_ao);
	$gsent3->execute();
	$resultadoat = $gsent3->fetchAll();


	function fechaCastellano ($fecha) {
	  $fecha = substr($fecha, 0, 10);
	  $numeroDia = date('d', strtotime($fecha));
	  $dia = date('l', strtotime($fecha));
	  $mes = date('F', strtotime($fecha));
	  $anio = date('Y', strtotime($fecha));
	  $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
	  $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
	  $nombredia = str_replace($dias_EN, $dias_ES, $dia);
	  $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
	  $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
	  $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
	  return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
	}


	date_default_timezone_set('america/santiago');
	$fecha_actual=date("Y-m-d H:i:s");


    $errors = array();

    if (!empty($_POST))
    {
        $nombre = $mysqli->real_escape_string($_POST['nombre']);
        $usuario = $mysqli->real_escape_string($_POST['usuario']);
        $password = $mysqli->real_escape_string($_POST['password']);
        $con_password = $mysqli->real_escape_string($_POST['con_password']);
        $email = $mysqli->real_escape_string($_POST['email']);
        
        $id_tipo = $mysqli->real_escape_string($_POST['id_tipo']);
        
		$activo = 0;
		$tipo_usuario = $id_tipo;
        
        
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
        

                
                $pass_hash = hashPassword($password);
                $token = generateToken();
                
                $registro = registraUsuario($usuario, $pass_hash, $nombre, $email, $activo, $token, $tipo_usuario);
                
                if($registro >0 ){
                    
                    $url = 'https://'.$_SERVER["SERVER_NAME"].'/pmtfacturas/activar.php?id='.$registro.'&val='.$token;
                    
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
            
            
        }
        
        
    }

?>

<!DOCTYPE html>
<html lang="es">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>PMT.CL | FACTURAS</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="img/favicon.png" rel="shortcut icon" />
    <link href="css/style.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap3-typeahead.min.js"></script>
    <script>
        // Tooltips Initialization
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>


</head>

<body>

    <!-- Start your project here-->

    <section class="widthmax elegant-color-dark">
        <div class="contenedor">
            <div class="row d-flex justify-content-end align-items-center py-3">

                <?php if($_SESSION["tipo_usuario"] <= 2) { ?>
                <div class="col-xs-6 col-md-1 cursor" data-toggle="tooltip" data-placement="bottom" title="Agregar Proveedor">
                    <div class="img-top" data-toggle="modal" data-target="#PROVEEDOR">
                        <img src="img/proveedor.svg" alt="">
                    </div>
                </div>
                <?php } ?>

                <?php if($_SESSION["tipo_usuario"] <= 2) { ?>
                <div class="col-xs-6 col-md-1 cursor" data-toggle="tooltip" data-placement="bottom" title="Agregar OT">
                    <div class="img-top" data-toggle="modal" data-target="#OTOBRA">
                        <img src="img/ot.svg" alt="">
                    </div>
                </div>
                <?php } ?>

                <?php if($_SESSION["tipo_usuario"] <= 2) { ?>
                <div class="col-xs-6 col-md-1 cursor" data-toggle="tooltip" data-placement="bottom" title="Agregar Admin de Obra">
                    <div class="img-top" data-toggle="modal" data-target="#ADMINOBRA">
                        <img src="img/administradorObra.svg" alt="">
                    </div>
                </div>
                <?php } ?>

                <?php if($_SESSION["tipo_usuario"] <= 2) { ?>
                <div class="col-xs-6 col-md-1 cursor" data-toggle="tooltip" data-placement="bottom" title="Agregar Factura">
                    <div class="img-top" data-toggle="modal" data-target="#FACTURANUEVA">
                        <img src="img/NuevaFactura.svg" alt="">
                    </div>
                </div>
                <?php } ?>

                <?php if($_SESSION["tipo_usuario"] <= 2) { ?>
                <div class="col-xs-6 col-md-1 cursor" data-toggle="tooltip" data-placement="bottom" title="Agregar Usuario">
                    <div class="img-top" data-toggle="modal" data-target="#REGISTRONUEVO">
                        <img src="img/NuevoRegistro.svg" alt="">
                    </div>
                </div>
                <?php } ?>

                <div class="col-xs-6 col-md-3">
                    <div class="Boton-sinaprobar mb-2">
                        <a href="facturas.php">
                            <h5>FACT. SIN APROBAR </h5>
                            <h6>0<?php echo $approvedno['approvedno']; ?></h6>
                        </a>
                    </div>
                    <div class="Boton-rechazadas mb-2">
                        <a href="facturas3.php">
                            <h5>FACT. RECHAZADAS </h5>
                            <h6>0<?php echo $rechazadas['rechazadas']; ?></h6>
                        </a>
                    </div>
                    <div class="Boton-aprobadas">
                        <a href="facturas2.php">
                            <h5>FACT. APROBADAS </h5>
                            <h6>0<?php echo $approvedsi['approvedsi']; ?></h6>
                        </a>
                    </div>
                </div>

                <div class="col-xs-6 col-md-2">
                    <div class="img-logo d-flex justify-content-end">
                        <img src="img/Logo_SVG_PMT.svg" alt="">
                    </div>
                </div>

                <div class="col-xs-6 col-md-2">
                    <div class="btn-group">
                        <button type="button" class="btn btn-color btn-sm round1"><?php echo $row['nombre']; ?></button>
                        <button type="button" class="btn btn-color btn-sm round2 dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu">
                            <?php if($_SESSION["tipo_usuario"] <= 2) { ?>
                            <a class="dropdown-item" href="modf_usuarios.php"><i class="fas fa-user-edit"></i> Modf. Usuarios</a>
                            <a class="dropdown-item" href="modf_proveedores.php"><i class="fas fa-user-edit"></i> Modf. Proveedores</a>
                            <a class="dropdown-item" href="modf_ordentrabajo.php"><i class="fas fa-user-edit"></i> Modf. Orden de Trabajo</a>
                            <a class="dropdown-item" href="modf_adminobra.php"><i class="fas fa-user-edit"></i> Modf. Admin de Obra</a>
                            <?php } ?>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="logout.php"><i class="far fa-times-circle"></i> Cerrar Sesion</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="ADMINOBRA" tabindex="-1" role="dialog" aria-labelledby="ADMINOBRA" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content LoginFondo">
                <?php include('aoadd.php'); ?>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="OTOBRA" tabindex="-1" role="dialog" aria-labelledby="OTOBRA" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content LoginFondo">
                <?php include('otadd.php'); ?>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="PROVEEDOR" tabindex="-1" role="dialog" aria-labelledby="PROVEEDOR" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content LoginFondo">
                <?php include('proveedoradd.php'); ?>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="FACTURANUEVA" tabindex="-1" role="dialog" aria-labelledby="FACTURANUEVA" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content LoginFondo">
                <?php include('facturanueva.php'); ?>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="REGISTRONUEVO" tabindex="-1" role="dialog" aria-labelledby="REGISTRONUEVO" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content LoginFondo">
                <?php include('registro.php'); ?>
            </div>
        </div>
    </div>