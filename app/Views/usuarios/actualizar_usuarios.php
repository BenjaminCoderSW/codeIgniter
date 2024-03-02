<?=$cabecera2?>
                <div class=" m-0 card card3 text-bg-dark position-absolute top-50 start-50 translate-middle" >
                    <form class="row card-body" action="<?=base_url('usuarios/actualizar')?>" method="post" enctype="multipart/form-data">
                    <div>
                        <input type="hidden" name="id" value="<?=$usuario['id_usuario']?>">
                    </div>
                        <div class="mb-2">
                            <h4 class="text-md-center text-sm-center"><strong>BenVani Cineplex</strong></h4>
                        </div>
                        <div class="col-sm-12 col-md-5 col-lg-5">
                            <label class="form-control-sm" for="nombre_usuario"><strong>Nombre de Usuario</strong></label>
                        </div>
                        <div class="col-sm-12 col-md-7 col-lg-7">
                            <span><input class="form-control form-control form-control mb-2" type="text" value="<?=$usuario['nombre_usuario']?>" placeholder="Ingresa tu Usuario" name="nombre_usuario" id="nombre_usuario" required value="<?=old('nombre_usuario')?>" /></span>
                        </div>
                        <div class="col-sm-12 col-md-5 col-lg-5">
                            <label class="form-control-sm" for="password"><strong>Password</strong></label>
                        </div>
                        <div class="col-sm-12 col-md-7 col-lg-7">
                            <span><input class="form-control form-control form-control mb-2" type="password" value="<?=$usuario['password']?>" name="password" id="password" placeholder="Ingresa tu Password"  /></span>
                        </div>
                        <div class="col-sm-12 col-md-5 col-lg-5">
                            <label class="form-control-sm" for="confirmar_password"><strong>Confirmar Password</strong></label>
                        </div>
                        <div class="col-sm-12 col-md-7 col-lg-7">
                            <span><input class="form-control form-control form-control mb-2" name="confirmar_password" value="<?=$usuario['password']?>" id="confirmar_password" type="password" placeholder="Confirma tu Password"  /></span>
                        </div>
                        <div class="col-sm-12 col-md-5 col-lg-5">
                            <label class="form-control-sm" for="tipo_usuario"><strong>Tipo de Usuario</strong></label>
                        </div>
                        <div class="col-sm-12 col-md-7 col-lg-7">
                            <select id="tipo_usuario" name="tipo_usuario" class="form-select mb-2" name="tipo_usuario">
                                <option value="Taquillero">Taquillero</option>
                                <option value="Administrador">Administrador</option>
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-5 col-lg-5">
                            <label class="form-control-sm" for="estado_usuario"><strong>Estado</strong></label>
                        </div>
                        <div class="col-sm-12 col-md-7 col-lg-7">
                            <select id="estado_usuario" name="estado_usuario" class="form-select mb-2" name="tipo_usuario">
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                            </select>
                        </div>
                        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 ">
                            
                        </div>
                        <div class=" col-sm-1 col-md-1 col-lg-1 col-xl-1 m-2 ">
                            <a href="<?=base_url('usuarios')?>" type="submit" id="btnEnviar" class="btn btn-danger ">Cancelar</a>
                        </div>
                        <div class=" col-sm-1 col-md-1 col-lg-1 col-xl-1 m-2 ">
                        <button class="btn btn-danger" type="submit">Guardar</button>
                        </div>
                    </form>
                </div>
<?=$piepagina?>