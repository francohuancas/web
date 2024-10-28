<?php
include 'Conexion.php'; // Conectar a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $trabajo_id = isset($_POST['trabajo_id']) ? $_POST['trabajo_id'] : 0;
    $cancelado = isset($_POST['cancelado']) ? 1 : 0; // Si está presente, se considera como 1 (true)

    // Actualizar el estado de cancelado en la base de datos
    $sql = "UPDATE trabajos SET cancelado = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $cancelado, $trabajo_id);
    
    if ($stmt->execute()) {
        // Redireccionar de vuelta a la página de trabajos del cliente
        header("Location: pagTrabajosCliente.php?cliente_id=" . $_POST['cliente_id']);
        exit;
    } else {
        echo "Error al actualizar el trabajo: " . $conn->error;
    }
}
?>
