<?=$cabecera?>

<div class="row">
    <div class="col-md-4">
        <img src="<?= base_url() ?>/uploads/<?= $pelicula['imagen']; ?>" class="card-img mt-3" style="object-fit: contain;" alt="...">
    </div>
    <div class="col-md-8">
        <input type="text" id="titulo_pelicula" class="form-control form-control-lg mt-3" value="<?= $pelicula['titulo_pelicula'] ?>" readonly>
        <label for="nombre_cliente" class="mt-3 p-1" style="font-size: 1.12rem; color: white;" ><Strong>Nombre del Cliente</Strong></label>
        <input type="text" id="nombre_cliente" class="form-control form-control-lg mt-3" value="<?= old('nombre_cliente')?>" placeholder="Nombre del Cliente">
        <select id="sala" class="form-select form-select-lg mt-3" onchange="actualizarHorarios()">
            <option value="">Seleccione una sala</option>
            <?php foreach ($salas as $sala): ?>
                <option value="<?= $sala['id_sala'] ?>"><?= $sala['nombre_sala'] ?></option>
            <?php endforeach; ?>
        </select>
        <select id="horarios" class="form-select form-select-lg mt-3">
            <option value="">Seleccione un horario</option>
        </select>
        <input type="date" id="fecha_compra" class="form-control form-control-lg mt-3" min="<?= date('Y-m-d') ?>" max="<?= date('Y-m-d', strtotime('+1 week')) ?>">
        <label for="numero_asientos" class="mt-3 p-1" style="font-size: 1.12rem; color: white;" ><Strong>Elija los asientos deseados</Strong></label>
        <input type="number" id="numero_asientos" class="form-control form-control-lg mt-3" placeholder="Número de Asientos" min="1" max="20" oninput="calcularPrecio()">
        <label for="precio_total" class="mt-3 p-1" style="font-size: 1.12rem; color: white;" ><Strong>Precio Total</Strong></label>
        <input type="text" id="precio_total" class="form-control form-control-lg mt-3" readonly>
        <label for="nombre_usuario" class="mt-3 p-1" style="font-size: 1.27rem; color: white; background-color:black;" >Usuario que le realizo la Venta: <Strong> <?= session('nombre_usuario') ?></Strong></label>
    </div>
</div>

<?=$piepagina?>

<script>
    // Define el precio de la película (puedes obtenerlo desde PHP si no está disponible en el frontend)
    var precioPelicula = <?= $pelicula['precio'] ?>;

    function actualizarHorarios() {
        var idSala = document.getElementById('sala').value;

        fetch('<?= site_url('taquilla/horarios/') ?>' + idSala)
            .then(response => response.json())
            .then(data => {
                console.log(data);

                var horariosDropdown = document.getElementById('horarios');
                var nombrePeliculaInput = document.getElementById('nombrePelicula');
                horariosDropdown.innerHTML = '<option value="">Seleccione un horario</option>';

                data.forEach(horario => {
                    var option = document.createElement('option');
                    option.value = horario.id_horario;
                    option.textContent = horario.horario_inicio;
                    horariosDropdown.appendChild(option);
                });
                var peliculaSeleccionada = document.getElementById('pelicula');
                var nombrePelicula = peliculaSeleccionada.options[peliculaSeleccionada.selectedIndex].text;
                nombrePeliculaInput.value = nombrePelicula;
            })
            .catch(error => {
                console.error('Error al obtener los horarios:', error);
            });
    }

    function calcularPrecio() {
        var numeroAsientos = document.getElementById('numero_asientos').value;
        var precioTotalInput = document.getElementById('precio_total');
        if (numeroAsientos >= 1 && numeroAsientos <= 20 && !isNaN(numeroAsientos) && Number.isInteger(parseFloat(numeroAsientos))) {
            var precioTotal = precioPelicula * numeroAsientos;
            precioTotalInput.value = precioTotal.toFixed(2); // Redondea el precio total a dos decimales
        } else {
            alert('Por favor, seleccione un número de asientos válido entre 1 y 20.');
            document.getElementById('numero_asientos').value = 1;
            precioTotalInput.value = ''; // Restablece el valor del precio total si el número de asientos no es válido
        }
    }
</script>
