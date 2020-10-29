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

    <section class="widthmax elegant-color-dark">
        <div class="contenedor">
            <div class="row d-flex justify-content-between align-items-center py-3">

                <div class="col-xs-6 col-md-1 cursor">
                    <div class="img-top">
                        <a class="img-top" href="index.php"><img src="img/NuevaFactura.svg" alt=""></a>
                    </div>
                </div>


                <div class="col-xs-6 col-md-2">
                    <div class="img-logo d-flex justify-content-end">
                        <a href="index.php" class="img-logo"><img src="img/Logo_SVG_PMT.svg" alt=""></a>
                    </div>
                </div>

                <div class="col-xs-6 col-md-2">
                    <div class="btn-group">
                        <button type="button" class="btn btn-color btn-sm round1"><?php echo $hud['nombre']; ?></button>
                        <button type="button" class="btn btn-color btn-sm round2 dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference2" data-toggle="dropdown2" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="modf_tipodeusuario.php"><i class="fas fa-user-edit"></i> Modf. Usuarios</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="logout.php"><i class="far fa-times-circle"></i> Cerrar Sesion</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Start your project here-->
    <section>
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-xs-12 col-md-5 my-4 ">
                    <!-- Default form register -->
                    <?php foreach($resultado as $dato ){ ?>
                    <form id="myForm" class="form-horizontal border border-light p-5 LoginAprobar" method="POST" action="facturaupdate.php" autocomplete="off" enctype="multipart/form-data">
                        <p class="h4 mb-4 text-center text-white">APROBAR FACTURA</p>
                        <input type="hidden" id="id" name="id" value="<?php echo $dato['id']; ?>" />
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="aprobada" class="control-label text-white">Numero de Factura</label>
                                <input type="text" class="form-control" name="nfactura" placeholder="" value="<?php echo $dato['nfactura'];?>" READONLY>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="aprobada" class="ccontrol-label text-white">Fecha de Factura</label>
                                <input type="date" class="form-control" name="fechafactura" placeholder="" value="<?php echo $dato['fechafactura'];?>" READONLY>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="aprobada" class="control-label text-white">RUT:</label>
                                <input type="text" class="form-control" name="rut" placeholder="RUT:" value="<?php echo $dato['rut'];?>" READONLY>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="aprobada" class="control-label text-white">Nombre de Proveedor</label>
                                <input type="text" class="form-control" name="nombre" placeholder="Nombre Proveedor:" value="<?php echo $dato['nombre'];?>" READONLY>
                            </div>
                        </div>
                        <div class="form-group">
							<div class="col-md-12 text-center">
                                <label for="aprobada" class="control-label text-white">Monto c/i:</label>
								<input type="text" name="monto_iva" id="monto_iva" value="<?php echo $dato['monto_iva'];?>" class="form-control" autocomplete="off" placeholder="" READONLY>
							</div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="aprobada" class="control-label text-white">Factura PDF</label>
                                <div class="custom-file">
									<input type="file" class="custom-file-input" name="" id="facturapdf" value="" readonly>
                                    <label class="custom-file-label" for="facturapdf"><?php echo $dato['facturapdf'];?></label>
                                </div>
                                <a type="button" class="btn btn-default red darken-3 btn-sm" target="_blank" href="img/Facturas/<?php echo $dato['facturapdf'];?>">
                                    VER PDF
                                </a>
                            </div>
                            <div class="col-md-12">
                                <label for="aprobada" class="control-label text-white">Factura Orden de Compra</label>
                                <div class="custom-file">
									<input type="file" class="custom-file-input" name="facturaoc" id="facturaoc">
                                    <label class="custom-file-label" for="facturaoc"><?php echo $dato['facturaoc'];?></label>
                                </div>
                                <a type="button" class="btn btn-default red darken-3 btn-sm" target="_blank" href="img/Orden_Compra/<?php echo $dato['facturaoc'];?>">
                                    VER OC
                                </a>
                            </div>
                            <div class="col-md-12">
                                <label for="aprobada" class="control-label text-white">Factura Nota de Credito</label>
                                <div class="custom-file">
									<input type="file" class="custom-file-input" name="facturanc" id="facturanc">
                                    <label class="custom-file-label" for="facturanc"><?php echo $dato['facturanc'];?></label>
                                </div>
                                <a type="button" class="btn btn-default red darken-3 btn-sm" target="_blank" href="img/Orden_Compra/<?php echo $dato['facturanc'];?>">
                                    VER NC
                                </a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="aprobada" class="col-sm-2 control-label text-white">¿Aprobar?</label>
                            <div class="col-xs-12 col-md-12">
                                <!-- Default inline 1-->
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="aprobadaSI" name="aprobada" value="1" <?php if($dato['aprobada']=='1') echo 'checked'; ?>>
                                    <label class="custom-control-label text-white" for="aprobadaSI">SI</label>
                                </div>

                                <!-- Default inline 2-->
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="aprobadaNO" name="aprobada" value="0" <?php if($dato['aprobada']=='0') echo 'checked'; ?>>
                                    <label class="custom-control-label text-white" for="aprobadaNO">NO</label>
                                </div>

                                <!-- Default inline 2-->
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="rechazar" name="aprobada" value="2" <?php if($dato['aprobada']=='2') echo 'checked'; ?>>
                                    <label class="custom-control-label text-white" for="rechazar">RECHAZAR</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="aprobada" class="ccontrol-label text-white">Fecha de Aprobación o Rechazo</label>
								<input type="datetime" class="form-control" name="fechaeditada" value="<?php echo $fecha_actual?>" disabled>
								<input type="hidden" class="form-control" name="fechaeditada" value="<?php echo $fecha_actual?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="nombre_obra" class="text-white">Orden de Trabajo</label>
                                <select class="form-control" id="ot_nombre_obra" onchange="ShowSelected();" name="nombre_obra">
                                    <option value="">Seleccionar Orden de Trabajo</option>
                                    <option value="<?php echo $dato['nombre_obra'];?>" <?php
                                    $not = $dato['nombre_obra'];
                                    if(empty($not)){
                                     echo 'hidden';
                                    } else {
                                     echo 'selected';
                                    }
                                    ?>><?php echo $dato['nombre_obra'];?></option>
                                    <?php foreach($resultadot as $row ){ ?>
                                    <option value="<?php echo $row['ot_nombre_obra'];?>"><?php echo $row['ot_nombre_obra'];?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="exampleFormControlSelect1" class="text-white">Direccion de Obra: </label>
                                <input class="inputlabelauto mt-2" id="ot_direccion_obra" name="direccion_obra" type="text" value="<?php echo $dato['direccion_obra'];?>" placeholder="" readonly />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="exampleFormControlSelect1" class="text-white">Mandante: </label>
                                <input class="inputlabelauto" id="ot_mandante" name="mandante" type="text" value="<?php echo $dato['mandante'];?>" placeholder="" readonly />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <select class="form-control" id="nombre_admin" name="nombre_admin">
                                    <option value="" selected>Administrador de Obra</option>
                                    <option value="<?php echo $dato['nombre_admin'];?>" <?php
                                    $not = $dato['nombre_admin'];
                                    if(empty($not)){
                                     echo 'hidden';
                                    } else {
                                     echo 'selected';
                                    }
                                    ?>><?php echo $dato['nombre_admin'];?></option>
                                    <?php foreach($resultadoat as $pull ){ ?>
                                    <option value="<?php echo $pull['ao_nombre'];?>"><?php echo $pull['id_ao'].' '.$pull['ao_nombre'];?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="exampleFormControlSelect1" class="text-white">Detalle: </label>
                                <textarea class="form-control rounded-0" placeholder="" id="detalle" name="detalle" rows="5"><?php echo $dato['detalle'];?></textarea>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="nombreuser" placeholder="" value="<?php echo ''.utf8_decode($hud['nombre']); ?>" hidden>
                            </div>
                        </div>



                        <!-- Sign in button -->
                        <a href="index.php" class="btn elegant-color ml-4 text-white">Regresar</a>
                        <button class="btn btn-info my-4" type="submit">Actualizar</button>


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