<?=$cabecera?>

<div class="row">
<div class="col-md-4 mx-2">
    <select id="sala" class="form-select mt-3" onchange="actualizarHorarios()">
        <option value="">Seleccione una sala</option>
        <?php foreach ($salas as $sala): ?>
            <option value="<?= $sala['id_sala'] ?>"><?= $sala['nombre_sala'] ?></option>
        <?php endforeach; ?>
    </select>
</div>
<div class="col-md-4 mx-2">
    <select id="horarios" class="form-select mt-3">
        <option value="">Seleccione un horario</option>
    </select>
</div>
</div>

<?=$piepagina?>
<script>
    function actualizarHorarios() {
        var idSala = document.getElementById('sala').value;

        fetch('<?= site_url('api/horarios/sala/') ?>' + idSala)
            .then(response => response.json())
            .then(data => {
                console.log(data); // Verifica los datos devueltos en la consola del navegador

                var horariosDropdown = document.getElementById('horarios');
                horariosDropdown.innerHTML = '<option value="">Seleccione un horario</option>';

                data.forEach(horario => {
                    // Agregar el horario de inicio al dropdown list
                    var option = document.createElement('option');
                    option.value = horario.id_horario;
                    option.textContent = horario.horario_inicio;
                    horariosDropdown.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error al obtener los horarios:', error);
            });
    }
</script>
