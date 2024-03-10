
<?=$cabecera?>
<br>
<div class="my-2 row">
<?php
// Obtener los valores de los filtros
$filtro_tipo_usuario = isset($_GET['tipo_usuario']) ? $_GET['tipo_usuario'] : '';
$filtro_estado_usuario = isset($_GET['estado_usuario']) ? $_GET['estado_usuario'] : '';
$filtro_nombre_usuario = isset($_GET['u']) ? $_GET['u'] : '';
?>
<form class="row" role="search">
    <div class="col-sm-12 col-md-3 col-lg-3 mx-1 mb-2">
        <select id="tipo_usuario" name="tipo_usuario" style="border: 2px solid #DA4E4E;" class="form-select">
            <option value="">Tipo de Usuario</option>
            <option value="Taquillero" <?= ($filtro_tipo_usuario == 'Taquillero') ? 'selected' : '' ?>>Taquillero</option>
            <option value="Administrador" <?= ($filtro_tipo_usuario == 'Administrador') ? 'selected' : '' ?>>Administrador</option>
        </select>
    </div>
    <div class="col-sm-12 col-md-3 col-lg-3 mx-1 mb-2">
        <select id="estado_usuario" name="estado_usuario" style="border: 2px solid #DA4E4E;" class="form-select">
            <option value="">Estado del Usuario</option>
            <option value="Activo" <?= ($filtro_estado_usuario == 'Activo') ? 'selected' : '' ?>>Activo</option>
            <option value="Inactivo" <?= ($filtro_estado_usuario == 'Inactivo') ? 'selected' : '' ?>>Inactivo</option>
        </select>
    </div>
    <div class="col-sm-12 col-md-3 col-lg-3 mx-1 mb-2">
        <input name="u" class="form-control me-2" style="border: 2px solid #DA4E4E;" type="search" placeholder="Buscar nombre de usuario..." aria-label="search" value="<?= $filtro_nombre_usuario ?>">
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
                            <form action="<?=base_url('usuarios/editar/'.$usuario['id_usuario'])?>" >
                                <button class="btn btn-light mb-1" type="submit">Editar</button>
                            </form>
                            <form action="<?=base_url('usuarios/borrar/'.$usuario['id_usuario'])?>" method="post" onsubmit="return confirmarEliminacion();">
                                <button class="btn btn-danger" type="submit">Borrar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

       <!-- Paginador -->
<nav aria-label="...">
    <ul class="pagination pagination-lg">
        <!-- Lógica para generar los enlaces de paginación -->
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <li class="page-item <?= ($i == $current_page) ? 'active' : '' ?>" aria-current="page">
                <!-- Se crean los botones dinamicamente -->
                <?php
                // Obtener los parámetros actuales de la URL
                $queryParams = $_GET;
                // Agregar el número de página actual a los parámetros
                $queryParams['page'] = $i;
                // Generar la URL con los nuevos parámetros
                $url = base_url('usuarios') . '?' . http_build_query($queryParams);
                ?>
                <a class="page-link" href="<?= $url ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>


<?=$piepagina?>