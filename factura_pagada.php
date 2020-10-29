<?php

	include_once 'funcs/Connection.php';
	require 'funcs/conexion.php';
    require 'funcs/funcs.php';
	
	$id = $_GET['id'];

	$sql_leer = "SELECT * FROM pmtfacturas WHERE id = '$id'";
	$gsent = $pdo->prepare($sql_leer);
	$gsent->execute();
	$resultado = $gsent->fetchAll();
	
	
	$sql_ot = "SELECT * FROM orden_de_trabajo";
	$gsent2 = $pdo->prepare($sql_ot);
	$gsent2->execute();
	$resultadot = $gsent2->fetchAll();
	
	
	$sql_ao = "SELECT * FROM admin_obra";
	$gsent3 = $pdo->prepare($sql_ao);
	$gsent3->execute();
	$resultadoat = $gsent3->fetchAll();
		
		
		
    session_start();

    $idUsuario = $_SESSION['id_usuario'];
	
	$sqlu = "SELECT id, nombre FROM usuarios WHERE id = '$idUsuario'";
	$result = $mysqli->query($sqlu);
	$hud = $result->fetch_assoc();

	
	


	date_default_timezone_set('america/santiago');
	$fecha_actual=date("Y-m-d H:i:s");

?>

<!DOCTYPE html>
<html lang="es">

<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>PMT.CL | EDITAR FACTURA</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>

    <!-- Start your project here-->
    <section>
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-xs-12 col-md-5 my-4 ">
                    <!-- Default form register -->
                    <?php foreach($resultado as $dato ){ ?>
                    <form id="myForm" class="form-horizontal border border-light p-5 LoginAprobar" method="POST" action="factura_pagada_editar.php" autocomplete="off" enctype="multipart/form-data">
						<div class="form-group d-flex justify-content-center align-items-center">
							<div class="col-md-12 LoginLogo text-center">
								<img src="img/Logo_SVG_PMT.svg" alt="">
								<h3>¿Factura Pagada?</h3>
							</div>
						</div>

						<div class="form-group d-flex justify-content-center align-items-center">
							<div class="row">
								<div class="form-group">
									<input type="hidden" id="id" name="id" value="<?php echo $dato['id']; ?>" />
									<div class="col-xs-12 col-md-12">
										<!-- Default inline 1-->
										<div class="custom-control custom-radio custom-control-inline">
											<input type="radio" class="custom-control-input" id="pagadaSI" name="pagado" value="1" <?php if($dato['pagado']=='1') echo 'checked'; ?>>
											<label class="custom-control-label text-white" for="pagadaSI">SI</label>
										</div>

										<!-- Default inline 2-->
										<div class="custom-control custom-radio custom-control-inline">
											<input type="radio" class="custom-control-input" id="pagadaNO" name="pagado" value="0" <?php if($dato['pagado']=='0') echo 'checked'; ?>>
											<label class="custom-control-label text-white" for="pagadaNO">NO</label>
										</div>
									</div>
								</div>
							</div>

						</div>
						<!-- Sign in button -->
						<button class="btn btn-login" type="submit">Actualizar</button>
					</form>
                    <?php } ?>
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

    <script type="text/javascript">
        $('#ot_nombre_obra').change(function(){
            nueva();
        });
 
        function nueva() {
            //alert('Funciona');
            var r = $('#ot_nombre_obra').val();
 
            $.ajax({ //Inicio del Ajax
                contentType: "application/x-www-form-urlencoded",
                type: "POST",
                url: "funcs/otfacturas.php",
                data: ({
                    option: 'obtener_rut',
                    ot_nombre_obra:    r
                }),
                dataType: "json",
                success: function(r) {
                    if(r.respuesta==''){
                        $('#ot_direccion_obra').val(r.ot_direccion_obra);
                        $('#ot_mandante').val(r.ot_mandante);
                    }else{
                        alert(r.respuesta);
                        $('#ot_direccion_obra').val('');
                        $('#ot_mandante').val('');
                    }
 
                }
            });//Fin del Ajax
        }
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