<form class="form-horizontal border border-light p-5" method="POST" action="aoguardar.php" autocomplete="off">
    <div class="form-group d-flex justify-content-center align-items-center">
        <div class="col-md-12 LoginLogo text-center">
            <img src="img/Logo_SVG_PMT.svg" alt="">
            <h3>Administrador de Obra</h3>
        </div>
    </div>

    <div class="form-group d-flex justify-content-center align-items-center">
        <div class="row">
            <div class="col-md-12 text-center">
                <label for="" class="textlabel">Nombre del Administrador:</label>
                <input id="textbox" type="text" class="form-control mb-1" name="ao_nombre" value="" placeholder="" required>
                
               <hr class="white">
            </div>
            <div class="col-md-8 text-center">
                <label for="" class="textlabel">Lista de Administradores:</label>
                <select class="custom-select custom-select-sm">
                    <option selected disabled>Abre este menú de selección</option>
                    <?php foreach($result_ao as $datoname): ?>
                    <option value="4"><?php echo $datoname['ao_nombre'];?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="col-md-4 text-center mt-4">
                <a href="modf_adminobra.php"><label for="" class="textlabel btn btn-sm stylish-color">Editar</label></a>
            </div>
        </div>

    </div>
    <!-- Sign in button -->
    <button class="btn btn-login" type="submit">Agregar</button>
</form>


<!-- Modal -->
<div class="modal fade" id="EDITARADMINOBRA" tabindex="-1" role="dialog" aria-labelledby="EDITARADMINOBRA" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <form action="funcs/editaradminobra.php" method="POST">
                            <table class="table table-striped thead-dark">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col"></th>
                                        <th scope="col">Nombre del Administrador de Obra</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($result_ao as $datoname): ?>
                                    <tr>
                                        <td scope="row"><?php echo $datoname['id_ao'];?></td>
                                        <td><input id="textbox" type="hidden" class="form-control" name="id_ao" value="<?php echo $datoname['id_ao'];?>"></td>
                                        <td><input id="textbox" type="text" class="form-control" name="ao_nombre" value="<?php echo $datoname['ao_nombre'];?>"></td>
                                        <td><button class="btn btn-login" type="submit">Guardar</button></td>
                                    </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>