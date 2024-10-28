<?php
include 'Conexion.php'; // Conectar a la base de datos

// Verificar si hay un apellido en la búsqueda
$apellido_busqueda = isset($_GET['apellido']) ? $_GET['apellido'] : '';

// Consulta para obtener clientes según el apellido buscado
$sql = "SELECT * FROM clientes";
if (!empty($apellido_busqueda)) {
    $sql .= " WHERE apellido LIKE '%$apellido_busqueda%'";
}
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Trabajos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
            color: #333;
        }
        h1 {
            text-align: center;
            color: #28a745; /* Color verde */
        }
        form {
            margin: 20px 0;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"],
        textarea {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        input[type="submit"],
        .btn-volver,
        .btn-agregar,
        .btn-ver-trabajos {
            background-color: #28a745; /* Color verde */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-align: center;
            display: inline-block; /* Asegura que el botón se comporte como un bloque */
            text-decoration: none; /* Sin subrayado */
        }
        input[type="submit"]:hover,
        .btn-volver:hover,
        .btn-agregar:hover,
        .btn-ver-trabajos:hover {
            background-color: #218838; /* Color verde más oscuro */
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
        .btn-container {
            text-align: center; /* Centrar el contenido del contenedor */
            margin-top: 20px; /* Margen superior para separar del resto */
        }
    </style>
</head>
<body>
    <h1>Lista de Clientes</h1>

    <form method="GET" action="">
        <input type="text" name="apellido" placeholder="Buscar por apellido" value="<?php echo htmlspecialchars($apellido_busqueda); ?>">
        <input type="submit" value="Buscar">
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($cliente = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $cliente['id']; ?></td>
                    <td><?php echo htmlspecialchars($cliente['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($cliente['apellido']); ?></td>
                    <td>
                        <a class="btn-agregar" href="agregarTrabajo.php?cliente_id=<?php echo $cliente['id']; ?>&apellido=<?php echo urlencode($apellido_busqueda); ?>">Agregar Trabajo</a>
                        <a class="btn-ver-trabajos" href="pagTrabajosCliente.php?cliente_id=<?php echo $cliente['id']; ?>">Ver Trabajos</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <!-- Botón para volver a la página principal -->
    <div class="btn-container">
        <form action="index.php" method="GET">
            <input type="submit" class="btn-volver" value="Volver a la página principal">
        </form>
    </div>
</body>
</html>
