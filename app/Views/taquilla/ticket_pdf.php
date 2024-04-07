<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket de compra</title>
    <style>
        /* Estilos CSS para el ticket */
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }
        .container {
            margin: 20px auto;
            width: 80%;
            border: 1px solid #ccc;
            padding: 20px;
            background-color: #f9f9f9;
        }
        h2 {
            margin-top: 0;
        }
        .ticket-details {
            margin-top: 20px;
        }
        .ticket-details table {
            width: 100%;
            border-collapse: collapse;
        }
        .ticket-details th,
        .ticket-details td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Ticket de compra</h2>
        <div class="ticket-details">
            <table>
                <tbody>
                    <tr>
                        <th>Folio</th>
                        <td><?= $ticket['folio'] ?></td>
                    </tr>
                    <tr>
                        <th>Nombre del Cliente</th>
                        <td><?= $ticket['nombre_cliente'] ?></td>
                    </tr>
                    <tr>
                        <th>Película</th>
                        <td><?= $pelicula['titulo_pelicula'] ?></td>
                    </tr>
                    <tr>
                        <th>Sala</th>
                        <td><?= $ticket['id_sala'] ?></td>
                    </tr>
                    <tr>
                        <th>Horario</th>
                        <td><?= $ticket['id_horario'] ?></td>
                    </tr>
                    <tr>
                        <th>Número de Asientos</th>
                        <td><?= $ticket['numero_asientos'] ?></td>
                    </tr>
                    <tr>
                        <th>Fecha de Compra</th>
                        <td><?= $ticket['fecha_compra'] ?></td>
                    </tr>
                    <tr>
                        <th>Total</th>
                        <td><?= $ticket['total'] ?></td>
                    </tr>
                    <tr>
                        <th>Vendido por</th>
                        <td><?= $ticket['id_usuario'] ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
