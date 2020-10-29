
<form id="signupform" class="form-horizontal text-center border border-light p-5" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
    <div class="form-group d-flex justify-content-center align-items-center">
        <div class="col-md-12 LoginLogo text-center">
            <img src="img/Logo_SVG_PMT.svg" alt="">
            <h3>Registrar Usuario</h3>
        </div>
    </div>

    <div class="form-group d-flex justify-content-center align-items-center">
        <div class="row">
            <div class="col-md-12 text-center">
                <label for="" class="textlabel">Nombre:</label>
                <input type="text" class="form-control" name="nombre" placeholder="" value="<?php if(isset($nombre)) echo $nombre; ?>" required>
            </div>
            <div class="col-md-12 text-center">
                <label for="" class="textlabel">Usuario:</label>
                <input type="text" class="form-control" name="usuario" placeholder="" value="<?php if(isset($usuario)) echo $usuario; ?>" required>
            </div>
            <div class="col-md-12 text-center">
                <label for="" class="textlabel">Contraseña:</label>
                <input type="password" class="form-control" name="password" placeholder="" required>
            </div>
            <div class="col-md-12 text-center">
                <label for="" class="textlabel">Confirmar Contraseña:</label>
                <input type="password" class="form-control" name="con_password" placeholder="" required>
            </div>
            <div class="col-md-12 text-center">
                <label for="" class="textlabel">Correo Electronico:</label>
                <input type="email" class="form-control" name="email" placeholder="" value="<?php if(isset($email)) echo $email; ?>" required>
            </div>
            <div class="col-md-12 text-center">
                <label for="aprobada" class="control-label textlabel">¿Nivel de Usuario?</label>
                <br>
                    <!-- Default inline 1-->
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="id_tipo1" name="id_tipo" value="2">
                        <label class="custom-control-label textlabel" for="id_tipo1">Administrador</label>
                    </div>
                    <!-- Default inline 2-->
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="id_tipo2" name="id_tipo" value="3">
                        <label class="custom-control-label textlabel" for="id_tipo2">Proveedor</label>
                    </div>
            </div>
            <!-- Sign in button -->
            <button class="btn btn-info btn-block my-4" type="submit">Registrar</button>
        </div>
    </div>
</form>
<?php echo resultBlock($errors); ?>