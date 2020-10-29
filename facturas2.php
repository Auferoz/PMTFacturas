<?php include('Header.php'); ?>



<section class="margin-textline">
    <div class="contenedor">
        <div class="row">
            <div class="col-xs-12 col-md-6 d-flex justify-content-between">
                <div class="Boton-green-aprobadas d-flex align-items-center justify-content-center">
                    <h5>FACTURAS APROBADAS</h5>
                </div>
            </div>
            <div class="col-xs-12 col-md-6 d-flex justify-content-end">
                <div class="Boton-green-aprobadas d-flex align-items-center justify-content-center">
                   <a href="#BOT"><h5>EXPORTAR</h5></a> 
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
                            <th class="th-sm aprove-si thid">ID</th>
                            <th class="th-sm aprove-si">N°Factura</th>
                            <th class="th-sm aprove-si">Fecha de Factura</th>
                            <th class="th-sm aprove-si">Fecha Ingreso de Factura</th>
                            <th class="th-sm aprove-si">Fecha de Aprobación</th>
                            <th class="th-sm aprove-si">Proveedor</th>
                            <th class="th-sm aprove-si">RUT</th>
                            <th class="th-sm aprove-si">Nombre Obra</th>
                            <th class="th-sm aprove-si">Direccion Obra</th>
                            <th class="th-sm aprove-si">Mandante</th>
                            <th class="th-sm aprove-si">Nombre Administrador</th>
                            <th class="th-sm aprove-si">Monto c/i</th>
                            <th class="th-sm aprove-si">Detalle</th>
                            <th class="th-sm aprove-si">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $rsltd_uno->fetch_assoc()) { ?>
                        <tr class="<?php $pagadosi = $row['pagado']; if($pagadosi =='1'){echo 'cpago';}else{ echo '';}?>">
                            <td class="tdstyle"><?php echo $row['id'];?></td>
                            <td class="tdstyle"><?php echo $row['nfactura'];?></td>
                            <td class="tdstyle" data-toggle="tooltip" data-placement="bottom" title="<?php echo fechaCastellano($row['fechafactura']);?>">
							<?php $fechafactura = $row['fechafactura']; $d2=strtotime($fechafactura); echo date("d/m/Y", $d2);?></td>
                            <td class="tdstyle" data-toggle="tooltip" data-placement="bottom" title="<?php if (empty($fechaingreso)){echo '';}else{echo fechaCastellano($row['fechaingreso']);}?>" >
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
                                    $noaprobada = '0';
                                    $stts = $row['aprobada'];
											
                                    if ($stts == $noaprobada) { 
                                        echo 'class ="d-none"';
                                    } else {
                                    }
                                    ?>>
                                <a target="_blank" href="img/Facturas/<?php echo $row['facturapdf'];?>" data-toggle="tooltip" data-placement="bottom" title="VER PDF"><i class="far fa-file-pdf"></i></a>
                                <a target="_blank" href="img/Orden_Compra/<?php echo $row['facturaoc'];?>" data-toggle="tooltip" data-placement="bottom" title="VER OC"><i class="far fa-file-image"></i></a>
                                <a target="_blank" href="<?php if(empty($row['facturanc'])){echo '#';}else{echo 'img/Nota_Credito/'.$row['facturanc'];}?>" data-toggle="tooltip" data-placement="bottom" title="VER NC"><i class="far fa-file-alt"></i></a>
                                <?php if($_SESSION["tipo_usuario"] <= 2) { ?>
                                <a href="factura_pagada.php?id=<?php echo $row['id'];?>"><i class="fas fa-dollar-sign"></i></a>
                                <a href="facturaeditar.php?id=<?php echo $row['id'];?>" data-toggle="tooltip" data-placement="bottom" title="EDITAR"><i class="fas fa-pencil-alt"></i></a>
                                <a target="_blank" href="#" data-target="#confirm-delete" data-toggle="modal" data-href="facturaeliminar.php?id=<?php echo $row['id'];?>"><i class="far fa-trash-alt"></i></a>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
				<div id="BOT"></div>
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

<!-- Llamar a los complementos javascript-->
<script src="js/jquery-1.12.4.min.js"></script>
<script src="js/FileSaver.min.js"></script>
<script src="js/Blob.min.js"></script>
<script src="js/xls.core.min.js"></script>
<script src="js/tableexport.js"></script>
<script>
$("table").tableExport({
	formats: ["xlsx","txt", "csv"], //Tipo de archivos a exportar ("xlsx","txt", "csv", "xls")
	position: 'bottom',  // Posicion que se muestran los botones puedes ser: (top, bottom)
	bootstrap: false,//Usar lo estilos de css de bootstrap para los botones (true, false)
	fileName: "ListadodeFacturas",    //Nombre del archivo 
});
</script>
</body>

</html>