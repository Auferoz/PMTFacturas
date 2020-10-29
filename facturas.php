<?php include('Header.php'); ?>


<section class="margin-textline">
    <div class="contenedor">
        <div class="row">
            <div class="col-xs-12 col-md-12 d-flex justify-content-between">
                <div class="Boton-red-sinaprobar d-flex align-items-center justify-content-center">
                    <h5>FACTURAS SIN APROBAR</h5>
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
                            <th class="th-sm aprove-no thid">ID</th>
                            <th class="th-sm aprove-no">N°Factura</th>
                            <th class="th-sm aprove-no">Fecha de Factura</th>
                            <th class="th-sm aprove-no">Fecha Ingreso de Factura</th>
                            <th class="th-sm aprove-no">Proveedor</th>
                            <th class="th-sm aprove-no">RUT</th>
                            <th class="th-sm aprove-no">Nombre Administrador</th>
                            <th class="th-sm aprove-no">Monto c/i</th>
                            <th class="th-sm aprove-no" style="width:100px;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $rsltd_dos->fetch_assoc()) { ?>
                        <tr>
                            <td class="tdstyle"><?php echo $row['id'];?></td>
                            <td class="tdstyle"><?php echo $row['nfactura'];?></td>
                            <td class="tdstyle" data-toggle="tooltip" data-placement="bottom" title="<?php echo fechaCastellano($row['fechafactura']);?>">
							<?php $fechafactura = $row['fechafactura']; $d2=strtotime($fechafactura); echo date("d/m/Y", $d2);?></td>
                            <td class="tdstyle" data-toggle="tooltip" data-placement="bottom" title="<?php if (empty($fechaingreso)){echo '';}else{echo fechaCastellano($row['fechaingreso']);}?>">
							<?php $fechaingreso = $row['fechaingreso']; if (empty($fechaingreso)){echo '';}else{$d2=strtotime($fechaingreso); echo date("d/m/Y H:m:s", $d2);}?></td>
                            <td class="tdstyle" data-toggle="tooltip" data-placement="bottom" title="<?php echo $row['nombre'];?>"><?php echo $row['nombre'];?></td>
                            <td class="tdstyle"><?php echo $row['rut'];?></td>
                            <td class="tdstyle" data-toggle="tooltip" data-placement="bottom" title="<?php echo $row['nombre_admin'];?>"><?php echo $row['nombre_admin'];?></td>
                            <td class="tdstyle">$ <?php $monto = $row['monto_iva']; if (empty($monto)) { echo '';}else{ echo number_format($monto,1);}?></td>
                            <td class="tdstyle">
                                <a target="_blank" href="img/Facturas/<?php echo $row['facturapdf'];?>" data-toggle="tooltip" data-placement="bottom" title="VER PDF"><i class="far fa-file-pdf"></i></a>
                                <?php if($_SESSION["tipo_usuario"] <= 3) { ?>
                                <a href="facturaeditar.php?id=<?php echo $row['id'];?>" data-toggle="tooltip" data-placement="bottom" title="APROBAR"><i class="far fa-check-circle"></i></a>
                                <?php } ?>
                                <?php if($_SESSION["tipo_usuario"] <= 2) { ?>
                                <a target="_blank" href="#" data-target="#confirm-delete" data-toggle="modal" data-href="facturaeliminar.php?id=<?php echo $row['id'];?>"><i class="fas fa-times" data-toggle="tooltip" data-placement="bottom" title="ELIMINAR"></i></a>
							</td>
                            <?php } ?>
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
                <button type="button" class="btn btn-default mr-3" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Eliminar</a>
            </div>
        </div>
    </div>
</div>


<?php include('copy.php'); ?>


<!-- Start your project here-->

<!-- SCRIPTS -->
<!-- JQuery -->

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
<script>
    $custom - file - text: (
        en: "Browse",
        es: "Elegir"
    );
</script>
<script>
    $(document).ready(function() {
        $("#rut").typeahead({
            source: function(query, resultado) {
                $.ajax({
                    url: "funcs/accion.php",
                    type: "POST",
                    dataType: "json",
                    data: {
                        query: query
                    },
                    success: function(data) {
                        resultado($.map(data, function(item) {
                            return item;
                        }));
                    }
                });
            }
        });
    });
</script>
<script>
    document.getElementById("rut").onchange = function() {
        alerta()
    };

    function alerta() {
        // Creando el objeto para hacer el request
        var request = new XMLHttpRequest();

        // Objeto PHP que consultaremos
        request.open("POST", "funcs/rutfacturas.php");

        // Definiendo el listener
        request.onreadystatechange = function() {
            // Revision si fue completada la peticion y si fue exitosa
            if (this.readyState === 4 && this.status === 200) {
                // Ingresando la respuesta obtenida del PHP
                document.getElementById("nombre").value = this.responseText;
            }
        };

        // Recogiendo la data del HTML
        var myForm = document.getElementById("myForm");
        var formData = new FormData(myForm);

        // Enviando la data al PHP
        request.send(formData);
    }
</script>
<script>
    function exportTableToExcel(tableID, filename = '') {
        var downloadLink;
        var dataType = 'application/vnd.ms-excel';
        var tableSelect = document.getElementById(tableID);
        var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

        // Specify file name
        filename = filename ? filename + '.xls' : 'excel_data.xls';

        // Create download link element
        downloadLink = document.createElement("a");

        document.body.appendChild(downloadLink);

        if (navigator.msSaveOrOpenBlob) {
            var blob = new Blob(['ufeff', tableHTML], {
                type: dataType
            });
            navigator.msSaveOrOpenBlob(blob, filename);
        } else {
            // Create a link to the file
            downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

            // Setting the file name
            downloadLink.download = filename;

            //triggering the function
            downloadLink.click();
        }
    }
</script>
</body>

</html>