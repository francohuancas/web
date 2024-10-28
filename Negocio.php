<?php
include 'conexion.php';

// Guardar cliente
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar si se han enviado los datos del cliente
    if (isset($_POST['nombre']) && isset($_POST['apellido'])) {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];

        // Consulta para insertar el cliente
        $sql_cliente = "INSERT INTO clientes (nombre, apellido) VALUES ('$nombre', '$apellido')";

        if ($conn->query($sql_cliente) === TRUE) {
            $cliente_id = $conn->insert_id; // Obtener el ID del nuevo cliente
            header("Location: pagClientes.php");
            exit();
        } else {
            echo "Error al registrar el cliente: " . $conn->error;
            exit;
        }
    }

    // Verificar si se han enviado los datos del trabajo
    if (isset($_POST['descripcion']) && isset($_POST['cliente_id'])) {
        $cliente_id = $_POST['cliente_id']; // Captura del cliente_id enviado
        $descripcion = $_POST['descripcion'];
        $monto = $_POST['monto'];
        $cancelado = isset($_POST['cancelado']) ? 1 : 0;

        // Consulta para insertar el trabajo
        $sql_trabajo = "INSERT INTO trabajos (cliente_id, descripcion, monto, cancelado) 
                        VALUES ('$cliente_id', '$descripcion', '$monto', '$cancelado')";

        if ($conn->query($sql_trabajo) === TRUE) {
            header("Location: pagTrabajosCliente.php?cliente_id=" . urlencode($cliente_id));
            exit();
        } else {
            echo "Error al registrar el trabajo: " . $conn->error;
            exit; // Terminar el script en caso de error
        }
    }
}

// Cerrar la conexión
$conn->close();

// Redirigir a la página principal si no hay acciones
header('Location: index.php');
exit();
?>
