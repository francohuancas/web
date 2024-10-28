<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Cliente</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        form {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input[type="text"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
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
        }
        /* Estilo para separar el botón del formulario */
        .button-container {
            text-align: center;
            margin-top: 30px; /* Mayor separación entre el formulario y el botón */
        }
    </style>
</head>
<body>

    <h1>Agregar Nuevo Cliente</h1>

    <!-- Formulario para agregar cliente -->
    <form action="Negocio.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required>

        <input type="submit" value="Agregar Cliente">
    </form>

    <!-- Botón para volver a la lista de clientes con más espacio -->
    <div class="button-container">
        <button onclick="location.href='pagClientes.php'">Volver a Lista de Clientes</button>
    </div>

</body>
</html>
