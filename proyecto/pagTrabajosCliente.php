<?php
include 'Conexion.php'; // Conectar a la base de datos

// Obtener el ID del cliente
$cliente_id = isset($_GET['cliente_id']) ? $_GET['cliente_id'] : 0;

// Consulta para obtener información del cliente
$sql_cliente = "SELECT * FROM clientes WHERE id = $cliente_id";
$result_cliente = $conn->query($sql_cliente);
$cliente = $result_cliente->fetch_assoc();

// Consulta para obtener trabajos del cliente
$sql_trabajos = "SELECT * FROM trabajos WHERE cliente_id = $cliente_id";
$result_trabajos = $conn->query($sql_trabajos);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trabajos del Cliente</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
            color: #333;
        }
        h2 {
            text-align: center;
            color: #333; /* Color del título */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #28a745; /* Color verde */
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .btn-volver {
            background-color: #28a745; /* Color verde del botón */
            color: white; /* Color del texto */
            padding: 10px 15px;
            border: none;
            border-radius: 5px; /* Bordes redondeados */
            cursor: pointer;
            text-align: center;
            display: inline-block; /* Asegura que el botón se comporte como un bloque */
            margin: 10px; /* Espacio alrededor del botón */
        }
        .btn-volver:hover {
            background-color: #218838; /* Color al pasar el ratón */
        }
        .btn-container {
            text-align: center; /* Centrar el contenido del contenedor */
            margin-top: 20px; /* Margen superior para separar del resto */
        }
    </style>
</head>
<body>
    
    <h2>Trabajos del Cliente: <?php echo htmlspecialchars($cliente['nombre'] . ' ' . $cliente['apellido']); ?></h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Descripción</th>
                <th>Monto</th>
                <th>Cancelado</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($trabajo = $result_trabajos->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $trabajo['id']; ?></td>
                    <td><?php echo htmlspecialchars($trabajo['descripcion']); ?></td>
                    <td><?php echo htmlspecialchars($trabajo['monto']); ?></td>
                    <td>
                        <form method="POST" action="actualizarTrabajo.php">
                            <input type="hidden" name="trabajo_id" value="<?php echo $trabajo['id']; ?>">
                            <input type="hidden" name="cliente_id" value="<?php echo $cliente_id; ?>">
                            <input type="checkbox" name="cancelado" value="1" <?php echo $trabajo['cancelado'] ? 'checked' : ''; ?> onchange="this.form.submit();">
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <div class="btn-container">
        <form action="pagTrabajos.php" method="GET" style="display: inline;">
            <input type="submit" class="btn-volver" value="Volver a la página de trabajos">
        </form>
        <form action="index.php" method="GET" style="display: inline;">
            <input type="submit" class="btn-volver" value="Volver a la página principal">
        </form>
    </div>
</body>
</html>
