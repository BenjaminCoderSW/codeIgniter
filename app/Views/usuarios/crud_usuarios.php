<?=$cabecera?>
<br>
<div class="my-2 row">
    <form class="row" role="search">
        <div class="col-sm-12 col-md-3 col-lg-3 mx-1 mb-2">
            <select id="tipo_usuario" name="tipo_usuario" style="border: 2px solid #DA4E4E;" class="form-select">
                <option value="tipo_usuario">Tipo de Usuario</option>
                <option value="Taquillero">Taquillero</option>
                <option value="Administrador">Administrador</option>
            </select>
        </div>
        <div class="col-sm-12 col-md-3 col-lg-3 mx-1 mb-2" >
            <select id="estado_usuario" name="estado_usuario" style="border: 2px solid #DA4E4E;" class="form-select">
                <option value="estado_usuario">Estado del Usuario</option>
                <option value="Activo">Activo</option>
                <option value="Inactivo">Inactivo</option>
            </select>
        </div>
        <div class="col-sm-12 col-md-3 col-lg-3 mx-1 mb-2">
            <input name="u" class="form-control me-2" style="border: 2px solid #DA4E4E;" type="search" placeholder="Buscar nombre de usuario..." aria-label="search">
        </div>
        <div class="col-sm-12 col-md-2 col-lg-2 mx-1 mb-2">
            <button class="btn btn-danger " type="submit" id="btnBuscar">Buscar</button>
        </div>
    </form>
</div>
    <a href="<?=base_url('usuarios/crear')?>" class="btn btn-danger mb-2" type="button">Crear un Usuario</a>
        <br>
        <table class="table table-dark mt-2">
            <thead class="table-ligth">
                <tr>
                    <th class="w-25 text-center">Usuario</th>
                    <th class="w-25 text-center">Tipo</th>
                    <th class="w-25 text-center">Estado</th>
                    <th class="w-25 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario):?>
                    <tr>
                        <td class="w-25 text-center"><?=$usuario['nombre_usuario'];?></td>
                        <td class="w-25 text-center"><?=$usuario['tipo_usuario']; ?></td>
                        <td class="w-25 text-center"><?=$usuario['estado_usuario']; ?></td>
                        <td class="w-25 text-center">
                            <a href="<?=base_url('usuarios/editar/'.$usuario['id_usuario'])?>" class="btn btn-light m-1" type="button">Editar</a>
                            <a href="<?=base_url('usuarios/borrar/'.$usuario['id_usuario'])?>" class="btn btn-danger m-1" type="button">Borrar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <nav aria-label="Page navigation example" style="background-color: rgba(255, 255, 255, 1); color: white; padding: 5px;">
            <ul class="pagination justify-content-center">
                <?= $pager->links() ?>
            </ul>
        </nav>
<?=$piepagina?>