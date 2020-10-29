<form class="form-horizontal border border-light p-5" method="POST" action="otguardar.php" autocomplete="off">
    <div class="form-group d-flex justify-content-center align-items-center">
        <div class="col-md-12 LoginLogo text-center">
            <img src="img/Logo_SVG_PMT.svg" alt="">
            <h3>Orden de Trabajo</h3>
        </div>
    </div>

    <div class="form-group d-flex justify-content-center align-items-center">
        <div class="row">
            <div class="col-md-12 text-center">
                <label for="" class="textlabel">Nombre de la Obra:</label>
                <input type="text" class="form-control" name="ot_nombre_obra" placeholder="" required>
            </div>
            <div class="col-md-12 text-center">
                <label for="" class="textlabel">Direccion de la Obra:</label>
                <input type="text" class="form-control" name="ot_direccion_obra" placeholder="" required>
            </div>
            <div class="col-md-12 text-center">
                <label for="" class="textlabel">Mandante de la Obra:</label>
                <input type="text" class="form-control" name="ot_mandante" placeholder="" required>
                
               <hr class="white">
            </div>
            <div class="col-md-8 text-center">
                <label for="" class="textlabel">Lista de Obras:</label>
                <select class="custom-select custom-select-sm">
                    <option selected disabled>Abre este menú de selección</option>
                    <?php foreach($result_ot as $otdato): ?>
                    <option value="4"><?php echo $otdato['ot_nombre_obra'];?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="col-md-4 text-center mt-4">
                <a href="modf_ordentrabajo.php"><label for="" class="textlabel btn btn-sm stylish-color">Editar</label></a>
            </div>
        </div>
    </div>
    <!-- Sign in button -->
    <button class="btn btn-login" type="submit">Agregar</button>
</form>