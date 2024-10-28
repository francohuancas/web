<?php
include 'Conexion.php'; // Conectar a la base de datos

if (isset($_GET['cliente_id'])) {
    $cliente_id = $_GET['cliente_id'];

    // Obtener el nombre del cliente
    $sql_cliente = "SELECT nombre, apellido FROM clientes WHERE id = '$cliente_id'";
    $cliente_info = $conn->query($sql_cliente)->fetch_assoc();
}

// Verificar si hay un término de búsqueda en la URL
$apellido_busqueda = isset($_GET['apellido']) ? $_GET['apellido'] : '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Trabajo</title>
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
        .checkbox-container {
            display: flex;
            align-items: center; /* Centrar verticalmente el contenido */
            margin-bottom: 10px; /* Espacio debajo del checkbox */
        }
        input[type="submit"] {
            background-color: #28a745; /* Color verde */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            display: block; /* Hacer que el botón sea un bloque */
            margin: 20px auto; /* Centrar el botón */
        }
        input[type="submit"]:hover {
            background-color: #218838; /* Color verde más oscuro */
        }
        .btn-volver {
            display: block;
            margin: 20px auto; /* Centrar el botón horizontalmente */
            padding: 10px 20px;
            background-color: #28a745; /* Color verde del botón */
            color: white; /* Color del texto */
            border: none;
            border-radius: 5px; /* Bordes redondeados */
            cursor: pointer;
            text-align: center;
        }
        .btn-volver:hover {
            background-color: #218838; /* Color al pasar el ratón */
        }
    </style>
</head>
<body>
    <h1>Agregar Trabajo para <?php echo htmlspecialchars($cliente_info['nombre'] . ' ' . $cliente_info['apellido']); ?></h1>

    <form action="Negocio.php" method="POST">
        <input type="hidden" name="cliente_id" value="<?php echo htmlspecialchars($cliente_id); ?>">
        
        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" rows="4" required></textarea>

        <label for="monto">Monto:</label>
        <input type="number" name="monto" required>

        <label>Trabajo Cancelado:</label>
        <div class="checkbox-container">
            <input type="checkbox" name="cancelado" value="1" id="cancelado">
            <label for="cancelado" style="margin-left: 5px;">Sí</label>
        </div>

        <input type="submit" value="Agregar Trabajo">
    </form>

    <button class="btn-volver" onclick="window.location.href='pagTrabajos.php?apellido=<?php echo urlencode($apellido_busqueda); ?>';">Volver a la Página de Trabajos</button>
    <button class="btn-volver" onclick="window.location.href='index.php';">Volver a la Página Principal</button>
</body>
</html>