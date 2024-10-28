<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <style>
        /* Estilo básico para la tabla */
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        h1 {
            text-align: center;
            margin: 20px 0;
        }
        /* Estilo para los botones de abajo */
        .button-container {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Lista de Clientes</h1>

    <?php
    include 'conexion.php'; // Incluir archivo de conexión

    // Consulta para obtener todos los clientes
    $sql = "SELECT id, nombre, apellido FROM clientes";
    $result = $conn->query($sql); // Ejecutar la consulta

    if ($result === false) {
        // Manejar error en la consulta
        echo "<p style='color: red;'>Error en la consulta: " . $conn->error . "</p>";
    } elseif ($result->num_rows > 0) {
        // Hay resultados, mostrar la tabla
        echo "<table>";
        echo "<tr><th>ID</th><th>Nombre</th><th>Apellido</th></tr>";
        
        // Mostrar los resultados en la tabla
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row['id'] . "</td><td>" . $row['nombre'] . "</td><td>" . $row['apellido'] . "</td></tr>";
        }
        
        echo "</table>";
    } else {
        // No hay clientes registrados
        echo "<p>No hay clientes registrados.</p>";
    }

    // Cerrar la conexión
    $conn->close();
    ?>

    <!-- Contenedor de botones para volver y agregar clientes -->
    <div class="button-container">
        <button onclick="location.href='index.php'">Volver a la Página Principal</button>
        <button onclick="location.href='agregarcliente.php'">Agregar Cliente</button>
    </div>
</body>
</html>
