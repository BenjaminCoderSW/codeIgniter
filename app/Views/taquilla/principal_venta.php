<?=$cabecera?>
<br>
<div class="my-2 row">
    <?php
    // Obtener los valores de los filtros
    $filtro_fecha = isset($_GET['fecha']) ? $_GET['fecha'] : '';
    $filtro_usuario = isset($_GET['usuario']) ? $_GET['usuario'] : '';
    $filtro_folio = isset($_GET['folio']) ? $_GET['folio'] : '';
    ?>
    <div class="row justify-content-center">
        <div class="col-12 col-md-10">
            <form class="row" role="search">
                <div class="col-12 col-sm-6 col-md-4 mb-2">
                    <select id="fecha" name="fecha" style="border: 2px solid #DA4E4E;" class="form-select">
                        <option value="">Seleccionar Fecha</option>
                        <?php foreach ($fechas as $fecha): ?>
                            <option value="<?= $fecha['fecha_compra'] ?>" <?= ($filtro_fecha == $fecha['fecha_compra']) ? 'selected' : '' ?>>
                                <?= $fecha['fecha_compra'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-12 col-sm-6 col-md-3 mb-2">
                    <select id="usuario" name="usuario" style="border: 2px solid #DA4E4E;" class="form-select">
                        <option value="">Seleccionar ID del Usuario</option>
                        <?php foreach ($usuarios as $usuario): ?>
                            <option value="<?= $usuario['id_usuario'] ?>" <?= ($filtro_usuario == $usuario['id_usuario']) ? 'selected' : '' ?>>
                                <?= $usuario['id_usuario'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-12 col-md-4 mb-2">
                    <select id="folio" name="folio" style="border: 2px solid #DA4E4E;" class="form-select">
                        <option value="">Seleccionar Folio</option>
                        <?php foreach ($folios as $folio): ?>
                            <option value="<?= $folio['folio'] ?>" <?= ($filtro_folio == $folio['folio']) ? 'selected' : '' ?>>
                                <?= $folio['folio'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-12 col-md-1 mb-2">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row justify-content-center mt-3">
        <?php foreach ($tickets as $ticket):?>
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="card h-100 tarjeta">
                    <div class="card-body">
                        <h5 class="card-title">Venta # <?=$ticket['id_ticket'];?></h5>
                        <p class="card-text">Folio de la venta <?=$ticket['folio']; ?></p>
                        <p class="card-text">Nombre del cliente <?=$ticket['nombre_cliente']; ?></p>
                        <p class="card-text">ID de la sala <?=$ticket['id_sala'];?></p>
                        <p class="card-text">ID del horario <?=$ticket['id_horario'];?></p>
                        <p class="card-text">ID del usuario que realizo la venta <?=$ticket['id_usuario'];?></p>
                        <p class="card-text">ID de la pelicula <?=$ticket['id_pelicula'];?></p>
                        <p class="card-text">Numero de asientos <?=$ticket['numero_asientos'];?></p>
                        <p class="card-text">Fecha de la venta <?=$ticket['fecha_compra'];?></p>
                        <p class="card-text">Total = $<?=$ticket['total']; ?></p>
                        <div class="text-center">
                            <form action="<?=base_url('ticket/editar/'.$ticket['id_ticket'])?>" >
                                <button class="btn btn-outline-danger mb-1" type="submit">Editar</button>
                            </form>
                            <form action="<?=base_url('ticket/borrar/'.$ticket['id_ticket'])?>" method="post" onsubmit="return confirmarEliminacionP();">
                                <button class="btn btn-outline-danger" type="submit" >Borrar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <nav aria-label="...">
        <ul class="pagination justify-content-center">
            <!-- Botón Previous -->
            <li class="page-item <?= ($current_page == 1) ? 'disabled' : '' ?>">
            <a class="page-link" href="<?= ($current_page == 1) ? '#' : base_url('ventas?page=' . ($current_page - 1)) ?>">Previous</a>
            </li>
            <!-- Botones de páginas -->
            <?php
            // Determinar el rango de botones a mostrar
            $start = max(1, $current_page - 2);
            $end = min($total_pages, $start + 3);
            // Generar botones de página
            for ($i = $start; $i <= $end; $i++) :
            ?>
            <li class="page-item <?= ($i == $current_page) ? 'active' : '' ?>">
                <a class="page-link" href="<?= base_url('ventas?page=' . $i) ?>"><?= $i ?></a>
            </li>
            <?php endfor; ?>
            <!-- Botón Next -->
            <li class="page-item <?= ($current_page == $total_pages) ? 'disabled' : '' ?>">
            <a class="page-link" href="<?= ($current_page == $total_pages) ? '#' : base_url('ventas?page=' . ($current_page + 1)) ?>">Next</a>
            </li>
        </ul>
    </nav>
</div>
<?=$piepagina?>
