<?php
include_once __DIR__.'/database.php';

// SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
$producto = file_get_contents('php://input');

if (!empty($producto)) {
    // SE TRANSFORMA EL STRING DEL JSON A OBJETO
    $jsonOBJ = json_decode($producto);

    // Validar que el nombre del producto no esté vacío
    if (empty($jsonOBJ->nombre)) {
        echo json_encode(['status' => 'error', 'message' => 'El nombre del producto es requerido.']);
        exit;
    }

    // Comprobar si el producto ya existe
    $nombreProducto = $jsonOBJ->nombre;

    $query = "SELECT * FROM productos WHERE nombre = '{$nombreProducto}' AND eliminado = 0";
    $result = $conexion->query($query);

    if ($result && $result->num_rows > 0) {
        // Producto ya existe
        echo json_encode(['status' => 'error', 'message' => 'El producto ya existe y no está eliminado.']);
    } else {
        // Si no existe, realizar la inserción
        $precio = $jsonOBJ->precio;
        $unidades = $jsonOBJ->unidades;
        $modelo = $jsonOBJ->modelo;
        $marca = $jsonOBJ->marca;
        $detalles = $jsonOBJ->detalles;
        $imagen = $jsonOBJ->imagen;

        $insertQuery = "INSERT INTO productos (nombre, precio, unidades, modelo, marca, detalles, imagen, eliminado) VALUES ('{$nombreProducto}', {$precio}, {$unidades}, '{$modelo}', '{$marca}', '{$detalles}', '{$imagen}', 0)";

        if ($conexion->query($insertQuery) === TRUE) {
            echo json_encode(['status' => 'success', 'message' => 'Producto registrado correctamente.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al registrar el producto: ' . $conexion->error]);
        }
    }

    // Liberar el resultado
    $result->free();
} else {
    echo json_encode(['status' => 'error', 'message' => 'No se recibieron datos para insertar.']);
}

// Cerrar la conexión
$conexion->close();
?>
