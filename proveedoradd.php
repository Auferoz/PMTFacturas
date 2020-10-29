<form class="form-horizontal border border-light p-5" method="POST" action="proveedorguardar.php" autocomplete="off">
    <div class="form-group d-flex justify-content-center align-items-center">
        <div class="col-md-12 LoginLogo text-center">
            <img src="img/Logo_SVG_PMT.svg" alt="">
            <h3>Proveedor</h3>
        </div>
    </div>

    <div class="form-group d-flex justify-content-center align-items-center">
        <div class="row">
            <div class="col-md-12 text-center">
                <label for="" class="textlabel">Nombre del Proveedor:</label>
                <input type="text" class="form-control" name="nombre_proveedor" placeholder="" required>
            </div>
            <div class="col-md-12 text-center">
                <label for="" class="textlabel">RUT del Proveedor:</label>
                <input type="text" class="form-control" maxlength="10" id="rut_proveedor" name="rut_proveedor" placeholder="" required>
               <hr class="white">
            </div>
            <div class="col-md-8 text-center">
                <label for="" class="textlabel">Lista de Proveedores:</label>
                <select class="custom-select custom-select-sm">
                    <option selected disabled>Abre este menú de selección</option>
                    <?php foreach($result_prov as $datoprov): ?>
                    <option value="<?php echo $datoprov['id_proveedor'];?>"><?php echo $datoprov['nombre_proveedor'];?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="col-md-4 text-center mt-4">
                <a href="modf_proveedores.php"><label for="" class="textlabel btn btn-sm stylish-color">Editar</label></a>
            </div>
        </div>
    </div>
    <!-- Sign in button -->
    <button class="btn btn-login" type="submit">Agregar</button>
</form>

<script>
$(document).ready(Principal);
    function Principal(){
        var flag1 = true;
        $(document).on('keyup','[id=rut_proveedor]',function(e){
            if($(this).val().length == 8 && flag1) {
                $(this).val($(this).val()+"-");
                flag1 = false;
            }
        });
    }
</script>