<?=$cabecera?>

<div class="row">
    <div class="col-md-4">
        <img src="<?= base_url() ?>/uploads/<?= $pelicula['imagen']; ?>" class="card-img mt-3" style="object-fit: contain;" alt="...">
    </div>
    <div class="col-md-8">
        <input type="text" id="titulo_pelicula" class="form-control form-control-lg mt-3" value="<?= $pelicula['titulo_pelicula'] ?>" readonly>
        <select id="sala" class="form-select form-select-lg mt-3" onchange="actualizarHorarios()">
            <option value="">Seleccione una sala</option>
            <?php foreach ($salas as $sala): ?>
                <option value="<?= $sala['id_sala'] ?>"><?= $sala['nombre_sala'] ?></option>
            <?php endforeach; ?>
        </select>
        <select id="horarios" class="form-select form-select-lg mt-3">
            <option value="">Seleccione un horario</option>
        </select>
        <input type="date" id="fecha" class="form-control form-control-lg mt-3" min="<?= date('Y-m-d') ?>" max="<?= date('Y-m-d', strtotime('+1 week')) ?>">
    </div>
</div>

<?=$piepagina?>

<script>
    function actualizarHorarios() {
        var idSala = document.getElementById('sala').value;

        fetch('<?= site_url('taquilla/horarios/') ?>' + idSala)
            .then(response => response.json())
            .then(data => {
                console.log(data); // Verifica los datos devueltos en la consola del navegador

                var horariosDropdown = document.getElementById('horarios');
                var nombrePeliculaInput = document.getElementById('nombrePelicula');
                horariosDropdown.innerHTML = '<option value="">Seleccione un horario</option>';

                data.forEach(horario => {
                    // Agregar el horario de inicio al dropdown list
                    var option = document.createElement('option');
                    option.value = horario.id_horario;
                    option.textContent = horario.horario_inicio;
                    horariosDropdown.appendChild(option);
                });

                // Obtener el nombre de la película seleccionada y mostrarlo en el input
                var peliculaSeleccionada = document.getElementById('pelicula');
                var nombrePelicula = peliculaSeleccionada.options[peliculaSeleccionada.selectedIndex].text;
                nombrePeliculaInput.value = nombrePelicula;
            })
            .catch(error => {
                console.error('Error al obtener los horarios:', error);
            });
    }
</script>
