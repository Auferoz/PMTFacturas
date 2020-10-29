<?php 

    
    session_start();
	include_once 'funcs/Connection.php';
	
	$sql_modf_user = "SELECT * FROM usuarios";
	$gsent = $pdo->prepare($sql_modf_user);
	$gsent->execute();
	$modf_user = $gsent->fetchAll();
	
	if($_GET){
        $id = $_GET['id'];
        $sql_unico = "SELECT * FROM usuarios WHERE id=?";
        $gsent_unico = $pdo->prepare($sql_unico);
        $gsent_unico->execute(array($id));
        $modf_user_unico = $gsent_unico->fetch();
    }


    require 'funcs/conexion.php';
    require 'funcs/funcs.php';

    if(!isset($_SESSION["id_usuario"])){ //Si no ha iniciado sesión redirecciona a index.php
		header("Location: index.php");
	}

    $idUsuario = $_SESSION['id_usuario'];

	$sqlu = "SELECT id, nombre FROM usuarios WHERE id = '$idUsuario'";
	$result = $mysqli->query($sqlu);
	$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
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

                <div class="col-xs-12 col-md-2">
					<div class="d-flex">
					  <div class="btn-group">
						<button type="button" class="btn btn-color round1"><?php echo $row['nombre']; ?></button>
						<button type="button" class="btn btn-color dropdown-toggle dropdown-toggle-split round2" id="dropdownMenuReference" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
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
        </div>
    </section>



    <section>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-12">
                    <div class="form-group d-flex justify-content-center align-items-center">
                        <div class="col-xs-12 col-md-12 text-center my-3 TextGrande">
                            <h1>Modificar Usuarios</h1>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-6">
                    <table class="table LoginAprobar" style="color:#FFF;">
                        <tr>
                            <th scope="col">
                                <h4>#ID</h4>
                            </th>
                            <th scope="col">
                                <h4>Nombre de Usuario</h4>
                            </th>
                            <th scope="col">
                                <h4>Tipo de Usuario</h4>
                            </th>
                        </tr>
                        <?php foreach($modf_user as $row_modf_user): ?>
                        <tr <?php if ($row_modf_user['id'] === '1'){echo 'class ="d-none"';}else{}?>>
                            <td scope="col">
                                <h5><?php echo $row_modf_user['id'];?></h5>
                            </td>
                            <td scope="col">
                                <h5>
                                    <?php echo $row_modf_user['nombre'];?>
                                </h5>
                                <h6>
                                    <?php $prov='3'; if($row_modf_user['id_tipo']===$prov){echo 'Proveedor';}else{echo 'Administrador';}?>
                                </h6>
                            </td>
                            <td>
                                <a href="modf_usuarios.php?id=<?php echo $row_modf_user['id'];?>" class="btn special-color mr-5"><i class="fas fa-user-edit"></i> Editar</a>
                                <a target="_blank" href="#" data-target="#confirm-delete" data-toggle="modal" data-href="Modf_usuarios_delete.php?id=<?php echo $row_modf_user['id'];?>"><i class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </table>
                </div>
                <div class="col-xs-6 col-md-6">
                    <?php if($_GET):?>
                    <form action="modf_usuarios_edit.php" method="GET">
                        <div class="form-group LoginAprobar p-3">
                            <div class="row">
                                <div class="col-xs-12 col-md-12">
                                    <h4 class="text-white">Usuario a Modificar: <?php echo $modf_user_unico['nombre'];?></h4>
                                    <input type="hidden" name="id" value="<?php echo $modf_user_unico['id'];?>">
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <label for="inputnombre" class="col-form-label text-white">Nombre:</label>
                                    <input type="text" id="inputnombre" class="form-control" name="nombre" placeholder="" value="<?php echo $modf_user_unico['nombre'];?>" required>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <label for="inputcorreo" class="col-form-label text-white">Correo:</label>
                                    <input type="text" id="inputcorreo" class="form-control" name="correo" placeholder="" value="<?php echo $modf_user_unico['correo'];?>" required>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <label for="inputusuario" class="col-form-label text-white">Usuario:</label>
                                    <input type="text" id="inputusuario" class="form-control" name="usuario" placeholder="" value="<?php echo $modf_user_unico['usuario'];?>" required>
                                </div>
                                <div class="col-xs-12 col-md-6 mt-3">
                                    <div class="col-xs-12 col-md-12 d-flex justify-content-start">
                                        <!-- Default inline 2-->
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input type="radio" class="custom-control-input" id="prove<?php echo $modf_user_unico['id'];?>" name="id_tipo" value="3" <?php if($modf_user_unico['id_tipo']=='3') echo 'checked'; ?>>
                                            <label class="custom-control-label text-white" for="prove<?php echo $modf_user_unico['id'];?>">Proveedor</label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6 d-flex justify-content-start">
                                        <!-- Default inline 3-->
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input type="radio" class="custom-control-input" id="admin<?php echo $modf_user_unico['id'];?>" name="id_tipo" value="2" <?php if($modf_user_unico['id_tipo']=='2') echo 'checked'; ?>>
                                            <label class="custom-control-label text-white" for="admin<?php echo $modf_user_unico['id'];?>">Administrador</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-12">
                                    <button class="btn btn-login btn-sm mt-3">Modificar</button>
                                </div>
                            </div>
                    </form>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </section>

    
    

<!-- Modal -->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <div class="modal-body">
                ¿Desea eliminar este Usuario?
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Eliminar</a>
            </div>
        </div>
    </div>
</div>

    <?php include('copy.php'); ?>
    <!-- Bootstrap tooltips -->
<script type="text/javascript" src="js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="js/mdb.min.js"></script>
<script>
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

        $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
    });
</script>
<script>
    $('#confirm-delete-dos').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

        $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
    });
</script>
</body>

</html>