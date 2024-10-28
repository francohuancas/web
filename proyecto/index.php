<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <style>
        /* Reset básico */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Estilos del cuerpo */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px; /* Espaciado en todo el cuerpo */
        }

        /* Encabezados */
        h1, h2 {
            text-align: center;
            margin: 20px 0;
        }

        h3 {
            text-align: center;
            margin: 20px 0;
            color: red;
        }


        /* Estilo de tablas */
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

        /* Botones */
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

        /* Formularios */
        form {
            max-width: 500px;
            margin: 20px auto;
            padding: 15px;
            background: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type="text"],
        input[type="number"],
        input[type="submit"],
        input[type="checkbox"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        /* Media queries para responsividad */
        @media (max-width: 600px) {
            body {
                padding: 10px;
            }

            table {
                width: 100%;
            }

            button {
                width: 100%;
            }
        }
    </style>

</head>
<body>
    <h1>Página Principal</h1>
    
    <!-- Botones de navegación -->
    <div style="text-align: center;">
        <button onclick="location.href='pagClientes.php'">Clientes</button>
        <button onclick="location.href='pagTrabajos.php'">Trabajos</button>
    </div>

    <?php
    include 'Conexion.php'; // Incluir el archivo de conexión

    // Consulta para obtener clientes con trabajos no cancelados
    $sql = "SELECT DISTINCT c.id, c.nombre, c.apellido 
            FROM clientes c
            JOIN trabajos t ON c.id = t.cliente_id
            WHERE t.cancelado = 0";

    $result = $conn->query($sql); // Ejecutar la consulta

    if ($result === false) {
        // Manejar error en la consulta
        echo "<p style='color: red;'>Error en la consulta: " . $conn->error . "</p>";
    } elseif ($result->num_rows > 0) {
        // Hay resultados
        echo "<h3>LISTA NEGRA - DEUDORES</h3>";
        echo "<table>";
        echo "<tr><th>ID</th><th>Nombre</th><th>Apellido</th></tr>";
        
        // Mostrar los resultados en una tabla
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row['id'] . "</td><td>" . $row['nombre'] . "</td><td>" . $row['apellido'] . "</td></tr>";
        }
        
        echo "</table>";
    } else {
        // No hay resultados
        echo "<p>No hay clientes con trabajos no cancelados.</p>";
    }

    // Cerrar la conexión
    if (isset($conn) && $conn !== null) {
        $conn->close();
    }
    ?>
</body>
</html>
