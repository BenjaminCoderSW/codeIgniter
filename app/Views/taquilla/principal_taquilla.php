<?=$cabecera?>

<div class="row justify-content-center mt-3">
    <div class="col-md-4 text-center">
        <select id="pelicula" style="border: 2px solid #DA4E4E;" class="form-select mb-3">
            <option value="">Seleccione una película</option>
            <?php foreach ($peliculas_activas as $pelicula): ?>
                <option value="<?= $pelicula['id_pelicula'] ?>"><?= $pelicula['titulo_pelicula'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<div class="row justify-content-center mt-3" id="tarjetasPeliculas">
    <?php foreach ($peliculas as $pelicula):?>
        <div class="col-12 col-md-6 col-lg-4 mb-4 pelicula-card" data-pelicula-id="<?=$pelicula['id_pelicula']?>">
            <div class="card h-100 tarjeta">
                <img src="<?=base_url()?>/uploads/<?=$pelicula['imagen'];?>" class="card-img-top" style="object-fit: contain; height: 300px;" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?=$pelicula['titulo_pelicula'];?></h5>
                    <p class="card-text"><?=$pelicula['sinopsis'];?></p>
                    <p class="card-text"><small class="text-muted"><?=$pelicula['genero']; ?></small></p>
                    <p class="card-text">$ <?=$pelicula['precio']; ?></p>
                    <div class="text-center">
                        <form action="<?=base_url('peliculas/editar/'.$pelicula['id_pelicula'])?>" >
                            <button class="btn btn-outline-danger mb-1" type="submit">Editar</button>
                        </form>
                        <form action="<?=base_url('peliculas/borrar/'.$pelicula['id_pelicula'])?>" method="post" onsubmit="return confirmarEliminacionP();">
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
            <a class="page-link" href="<?= ($current_page == 1) ? '#' : base_url('taquilla?page=' . ($current_page - 1)) ?>">Previous</a>
        </li>
        <!-- Botones de páginas -->
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <li class="page-item <?= ($i == $current_page) ? 'active' : '' ?>">
                <a class="page-link" href="<?= base_url('taquilla?page=' . $i) ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>
        <!-- Botón Next -->
        <li class="page-item <?= ($current_page == $total_pages) ? 'disabled' : '' ?>">
            <a class="page-link" href="<?= ($current_page == $total_pages) ? '#' : base_url('taquilla?page=' . ($current_page + 1)) ?>">Next</a>
        </li>
    </ul>
</nav>

<?=$piepagina?>

<script>
    document.getElementById('pelicula').addEventListener('change', function() {
    var seleccion = this.value;
    var tarjetasPeliculas = document.querySelectorAll('.pelicula-card');

    tarjetasPeliculas.forEach(function(tarjeta) {
        var peliculaId = tarjeta.getAttribute('data-pelicula-id');
        if (peliculaId === seleccion || seleccion === '') {
            tarjeta.style.display = 'block';
        } else {
            tarjeta.style.display = 'none';
        }
    });
    
    // Mostrar todas las tarjetas de películas si no se selecciona ninguna película
    if (seleccion === '') {
        tarjetasPeliculas.forEach(function(tarjeta) {
            tarjeta.style.display = 'block';
        });
    }

    // Ocultar paginador cuando se selecciona una película
    document.querySelector('.pagination').style.display = 'none';
});

</script>
