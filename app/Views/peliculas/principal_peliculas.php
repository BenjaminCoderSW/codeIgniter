
<?=$cabecera?>
<br>
<div class="my-2 row">
<?php
// Obtener los valores de los filtros
$filtro_genero = isset($_GET['genero']) ? $_GET['genero'] : '';
$filtro_estado_pelicula = isset($_GET['estado_pelicula']) ? $_GET['estado_pelicula'] : '';
$filtro_titulo_pelicula = isset($_GET['u']) ? $_GET['u'] : '';
?>
<form class="row" role="search">
    <div class="col-sm-12 col-md-3 col-lg-3 mx-1 mb-2">
        <select id="genero" name="genero" style="border: 2px solid #DA4E4E;" class="form-select">
            <option value="">Género de la película</option>
            <option value="Terror" <?= ($filtro_genero == 'Terror') ? 'selected' : '' ?>>Terror</option>
            <option value="Suspenso" <?= ($filtro_genero == 'Suspenso') ? 'selected' : '' ?>>Suspenso</option>
            <option value="Comedia" <?= ($filtro_genero == 'Comedia') ? 'selected' : '' ?>>Comedia</option>
            <option value="Accion" <?= ($filtro_genero == 'Accion') ? 'selected' : '' ?>>Acción</option>
            <option value="Drama" <?= ($filtro_genero == 'Drama') ? 'selected' : '' ?>>Drama</option>
            <option value="Guerra" <?= ($filtro_genero == 'Guerra') ? 'selected' : '' ?>>Guerra</option>
            <option value="Musical" <?= ($filtro_genero == 'Musical') ? 'selected' : '' ?>>Musical</option>
            <option value="Ciencia ficcion" <?= ($filtro_genero == 'Ciencia ficcion') ? 'selected' : '' ?>>Ciencia ficción</option>
            <option value="Aventura" <?= ($filtro_genero == 'Aventura') ? 'selected' : '' ?>>Aventura</option>
            <option value="Romance" <?= ($filtro_genero == 'Romance') ? 'selected' : '' ?>>Romance</option>
            <option value="Animacion" <?= ($filtro_genero == 'Animacion') ? 'selected' : '' ?>>Animacion</option>
            <option value="Crimen" <?= ($filtro_genero == 'Crimen') ? 'selected' : '' ?>>Crimen</option>
            <option value="Documental" <?= ($filtro_genero == 'Documental') ? 'selected' : '' ?>>Documental</option>
        </select>
    </div>
    <div class="col-sm-12 col-md-3 col-lg-3 mx-1 mb-2">
        <select id="estado_pelicula" name="estado_pelicula" style="border: 2px solid #DA4E4E;" class="form-select">
            <option value="">Estado de la Pelicula</option>
            <option value="Activa" <?= ($filtro_estado_pelicula == 'Activa') ? 'selected' : '' ?>>Activa</option>
            <option value="Inactiva" <?= ($filtro_estado_pelicula == 'Inactiva') ? 'selected' : '' ?>>Inactiva</option>
        </select>
    </div>
    <div class="col-sm-12 col-md-3 col-lg-3 mx-1 mb-2">
        <input name="u" class="form-control me-2" style="border: 2px solid #DA4E4E;" type="search" placeholder="Buscar titulo de la pelicula..." aria-label="search" value="<?= $filtro_titulo_pelicula ?>">
    </div>
    <div class="col-sm-12 col-md-2 col-lg-2 mx-1 mb-2">
        <button class="btn btn-danger " type="submit" id="btnBuscar">Buscar</button>
    </div>
</form>
</div>
    <a href="<?=base_url('peliculas/crear')?>" class="btn btn-danger mb-2" type="button">Agregar una película</a>
        <br>

        <table class="table table-dark mt-2">
            <thead class="table-ligth">
                <tr>
                    <th class="w-25 text-center">Película</th>
                    <th class=" text-center">Portada</th>
                    <th class=" text-center">Género</th>
                    <th class=" text-center">Precio</th>
                    <th class=" text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($peliculas as $pelicula):?>
                    <tr>
                        <td class="w-25 text-center"><h3><?=$pelicula['titulo_pelicula'];?></h3>
                        <br>
                        <p><?=$pelicula['sinopsis'];?></p>
                        </td>
                        <td class=" text-center"><img class="img-thumbnail" src="<?=base_url()?>/uploads/<?=$pelicula['imagen'];?>" width="100" alt=""></td>
                        <td class=" text-center"><?=$pelicula['genero']; ?></td>
                        <td class=" text-center">$ <?=$pelicula['precio']; ?></td>
                        <td class=" text-center">
                            <form action="<?=base_url('peliculas/editar/'.$pelicula['id_pelicula'])?>" >
                                <button class="btn btn-light mb-1" type="submit">Editar</button>
                            </form>
                            <form action="<?=base_url('peliculas/borrar/'.$pelicula['id_pelicula'])?>" method="post" onsubmit="return confirmarEliminacionP();">
                                <button class="btn btn-danger" type="submit" >Borrar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

       <!-- Paginador -->
       <nav aria-label="...">
            <ul class="pagination">
                <!-- Botón Previous -->
                <li class="page-item <?= ($current_page == 1) ? 'disabled' : '' ?>">
                <a class="page-link" href="<?= ($current_page == 1) ? '#' : base_url('peliculas?page=' . ($current_page - 1)) ?>">Previous</a>
                </li>
                <!-- Botones de páginas -->
                <?php
                // Determinar el rango de botones a mostrar
                $start = max(1, $current_page - 2);
                $end = min($total_pages, $start + 4);

                // Generar botones de página
                for ($i = $start; $i <= $end; $i++) :
                ?>
                <li class="page-item <?= ($i == $current_page) ? 'active' : '' ?>">
                    <a class="page-link" href="<?= base_url('peliculas?page=' . $i) ?>"><?= $i ?></a>
                </li>
                <?php endfor; ?>
                <!-- Botón Next -->
                <li class="page-item <?= ($current_page == $total_pages) ? 'disabled' : '' ?>">
                <a class="page-link" href="<?= ($current_page == $total_pages) ? '#' : base_url('peliculas?page=' . ($current_page + 1)) ?>">Next</a>
                </li>
            </ul>
        </nav>
</div>
</body>
<script>
    function confirmarEliminacionP() {
        if (confirm("¿Estás seguro de que deseas eliminar esta Película?")) {
            return true;
        } else {
            return false;
        }
    }
</script>
</html>