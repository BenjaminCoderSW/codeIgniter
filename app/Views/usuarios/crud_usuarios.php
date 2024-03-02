<?=$cabecera?>
<br>
    <a href="<?=base_url('usuarios/crear')?>" class="btn btn-danger mb-2" type="button">Crear un Usuario</a>
        <br>
        <table class="table table-dark mt-2">
            <thead class="table-ligth">
                <tr>
                    <th class="w-25 text-center">#</th>
                    <th class="w-25 text-center">Usuario</th>
                    <th class="w-25 text-center">Estado</th>
                    <th class="w-25 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario):?>
                    <tr>
                        <td class="w-25 text-center"><?=$usuario['id_usuario'];?></td>
                        <td class="w-25 text-center"><?=$usuario['nombre_usuario']; ?></td>
                        <td class="w-25 text-center"><?=$usuario['estado_usuario']; ?></td>
                        <td class="w-25 text-center">
                            <a href="<?=base_url('usuarios/editar/'.$usuario['id_usuario'])?>" class="btn btn-light m-1" type="button">Editar</a>
                            <a href="<?=base_url('usuarios/borrar/'.$usuario['id_usuario'])?>" class="btn btn-danger m-1" type="button">Borrar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
<?=$piepagina?>