<form id="myForm" class="form-horizontal border border-light p-5" method="POST" action="facturaguardar.php" autocomplete="off" enctype="multipart/form-data">
    <div class="form-group d-flex justify-content-center align-items-center">
        <div class="col-md-12 LoginLogo text-center">
            <img src="img/Logo_SVG_PMT.svg" alt="">
            <h3>Agregar Factura Nueva</h3>
        </div>
    </div>

    <div class="form-group d-flex justify-content-center align-items-center">
        <div class="row">
            <div class="col-md-12 text-center">
                <label for="" class="textlabel">Numero de Factura:</label>
                <input type="text" class="form-control" name="nfactura" placeholder="" required>
            </div>
            <div class="col-md-12 text-center">
                <label for="" class="textlabel">Fecha de la Factura:</label>
                <input type="date" class="form-control" name="fechafactura" placeholder="" required>
            </div>
            <div class="col-md-12 text-center">
                <label for="" class="textlabel">Fecha Ingreso de factura:</label>
                <input type="datetime" class="form-control" name="fechaingreso" value="<?php echo $fecha_actual?>" disabled>
                <input type="hidden" class="form-control" name="fechaingreso" value="<?php echo $fecha_actual?>">
            </div>
            <div class="col-md-12 text-center">
                <label for="" class="textlabel">RUT del Proveedor:</label>
                <input type="text" name="rut" id="rut" class="form-control" autocomplete="off" placeholder="" required>
            </div>
            <div class="col-md-12 text-center">
                <label for="" class="textlabel">Nombre del Proveedor:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="" value="" readonly>
            </div>
            <div class="col-md-12 text-center my-3">
                    <select class="form-control" id="nombre_admin" name="nombre_admin">
                        <option value="" selected>Administrador de Obra</option>
                        <?php foreach($resultadoat as $pull ){ ?>
                        <option value="<?php echo $pull['ao_nombre'];?>"><?php echo $pull['id_ao'].' '.$pull['ao_nombre'];?></option>
                        <?php } ?>
                    </select>
                </div>
            <div class="col-md-12 text-center">
                <label for="" class="textlabel">Buscar Factura:</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="facturapdf" id="customFile" required>
                    <label class="custom-file-label" for="customFile">PDF</label>
                </div>
            </div>
            <div class="col-md-12 text-center">
                <label for="" class="textlabel">Monto c/i:</label>
                <input type="text" name="monto_iva" id="monto_iva" maxlength="13" class="form-control" autocomplete="off" placeholder="" required>
            </div>
            <div class="col-md-12 text-center">
                <div class="form-group d-none">
                    <label for="aprobada" class="col-sm-2 textlabel">¿Aprobada?</label>

                    <div class="col-sm-10">
                        <label class="radio-inline">
                            <input type="radio" id="aprobada" name="aprobada" value="1"> SI
                        </label>

                        <label class="radio-inline">
                            <input type="radio" id="aprobada" name="aprobada" value="0" checked> NO
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sign in button -->
    <button class="btn btn-login" type="submit">Agregar</button>
</form>