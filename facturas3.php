<?php include('Header.php'); ?>



<section class="margin-textline">
    <div class="contenedor">
        <div class="row">
            <div class="col-xs-12 col-md-12 d-flex justify-content-between">
                <div class="Boton-yellow-rechazadas d-flex align-items-center justify-content-center">
                    <h5>FACTURAS RECHAZADAS</h5>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="contenedor">
        <div class="row">
            <div class="col-xs-12 col-md-12 table-responsive text-nowrap">
                <table id="dtBasicExample" class="table table-radius table-hover table-striped table-bordered table-sm" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="th-sm rechazadas thid">ID</th>
                            <th class="th-sm rechazadas">N°Factura</th>
                            <th class="th-sm rechazadas">Fecha de Factura</th>
                            <th class="th-sm rechazadas">Fecha Ingreso de Factura</th>
                            <th class="th-sm rechazadas">Fecha de Rechazo</th>
                            <th class="th-sm rechazadas">Proveedor</th>
                            <th class="th-sm rechazadas">RUT</th>
                            <th class="th-sm rechazadas">Nombre Obra</th>
                            <th class="th-sm rechazadas">Direccion Obra</th>
                            <th class="th-sm rechazadas">Mandante</th>
                            <th class="th-sm rechazadas">Nombre Administrador</th>
                            <th class="th-sm rechazadas">Monto c/i</th>
                            <th class="th-sm rechazadas">Detalle</th>
                            <th class="th-sm rechazadas">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $rsltd_tres->fetch_assoc()) { ?>
                        <tr>
                            <td class="tdstyle"><?php echo $row['id'];?></td>
                            <td class="tdstyle"><?php echo $row['nfactura'];?></td>
                            <td class="tdstyle" data-toggle="tooltip" data-placement="bottom" title="<?php echo fechaCastellano($row['fechafactura']);?>">
							<?php $fechafactura = $row['fechafactura']; $d2=strtotime($fechafactura); echo date("d/m/Y", $d2);?></td>
                            <td class="tdstyle" data-toggle="tooltip" data-placement="bottom" title="<?php if (empty($fechaingreso)){echo '';}else{echo fechaCastellano($row['fechaingreso']);}?>">
							<?php $fechaingreso = $row['fechaingreso']; if (empty($fechaingreso)){echo '';}else{$d2=strtotime($fechaingreso); echo date("d/m/Y H:m:s", $d2);}?></td>
                            <td class="tdstyle" data-toggle="tooltip" data-placement="bottom" title="<?php if (empty($fechaeditada)){echo '';}else{echo fechaCastellano($row['fechaeditada']);}?>">
							<?php $fechaeditada = $row['fechaeditada']; if (empty($fechaeditada)){echo '';}else{$d2=strtotime($fechaeditada); echo date("d/m/Y H:m:s", $d2);}?></td>
                            <td class="tdstyle" data-toggle="tooltip" data-placement="bottom" title="<?php echo $row['nombre'];?>"><?php echo $row['nombre'];?></td>
                            <td class="tdstyle"><?php echo $row['rut'];?></td>
                            <td class="tdstyle"><?php echo $row['nombre_obra'];?></td>
                            <td class="tdstyle"><?php echo $row['direccion_obra'];?></td>
                            <td class="tdstyle"><?php echo $row['mandante'];?></td>
                            <td class="tdstyle" data-toggle="tooltip" data-placement="bottom" title="<?php echo $row['nombre_admin'];?>"><?php echo $row['nombre_admin'];?></td>
                            <td class="tdstyle">$ <?php $monto = $row['monto_iva']; if (empty($monto)) { echo '';}else{ echo number_format($monto,1);}?></td>
                            <td class="tdstyle" data-toggle="tooltip" data-placement="bottom" title="<?php echo $row['detalle'];?>"><?php echo $row['detalle'];?></td>
                            <td <?php 
                                    $rechazadas = '2';
                                    $stts = $row['aprobada'];
											
                                    if ($stts == $rechazadas) {
                                    } else {
                                        echo 'class ="d-none"';
                                    }
                                    ?>>
                                <a target="_blank" href="img/Facturas/<?php echo $row['facturapdf'];?>" data-toggle="tooltip" data-placement="bottom" title="VER PDF"><i class="far fa-file-pdf"></i></a>
                                <a target="_blank" href="img/Orden_Compra/<?php echo $row['facturaoc'];?>" data-toggle="tooltip" data-placement="bottom" title="VER OC"><i class="far fa-file-image"></i></a>
                                <a target="_blank" href="img/Nota_Credito/<?php echo $row['facturanc'];?>" data-toggle="tooltip" data-placement="bottom" title="VER NC"><i class="far fa-file-alt"></i></a>
                                <?php if($_SESSION["tipo_usuario"] <= 2) { ?>
                                <a href="facturaeditar.php?id=<?php echo $row['id'];?>" data-toggle="tooltip" data-placement="bottom" title="EDITAR"><i class="fas fa-pencil-alt"></i></a>
                                <a target="_blank" href="#" data-target="#confirm-delete" data-toggle="modal" data-href="facturaeliminar.php?id=<?php echo $row['id'];?>"><i class="far fa-trash-alt"></i></a>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
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
                ¿Desea eliminar esta Factura sin Aprobar?
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Eliminar</a>
            </div>
        </div>
    </div>
</div>


<?php include('copy.php'); ?>

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