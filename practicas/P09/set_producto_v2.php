<?php
// Función para conectar a la base de datos
function conectarBD() {
    $conexion = new mysqli('localhost', 'root', '12345678a', 'marketzone');
    if ($conexion->connect_errno) {
        exit('<p>Error en la conexión a la base de datos: ' . $conexion->connect_error . '</p>');
    }
    return $conexion;
}

// Función para validar campos obligatorios
function validarCampos($nombre, $marca, $modelo) {
    if (empty($nombre) || empty($marca) || empty($modelo)) {
        exit('<p>Faltan campos obligatorios (nombre, marca, modelo).</p>');
    }
}

// Función para verificar si el producto ya existe
function productoExiste($conexion, $nombre, $marca, $modelo) {
    $consulta = $conexion->prepare("SELECT * FROM productos WHERE nombre = ? AND marca = ? AND modelo = ?");
    $consulta->bind_param('sss', $nombre, $marca, $modelo);
    $consulta->execute();
    $resultado = $consulta->get_result();
    $consulta->close();
    return $resultado->num_rows > 0;
}

// Función para insertar un nuevo producto
function insertarProducto($conexion, $nombre, $marca, $modelo, $precio, $detalles, $unidades, $imagen) {
    // Ajustar el uso de los nombres de las columnas en la query INSERT INTO
    $consulta = $conexion->prepare("INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?)");
    $consulta->bind_param('sssdsis', $nombre, $marca, $modelo, $precio, $detalles, $unidades, $imagen);
    $exito = $consulta->execute();
    $id_insertado = $consulta->insert_id;
    $consulta->close();
    return $exito ? $id_insertado : false;
}

// Función para mostrar el resumen del producto
function mostrarResumen($id_producto, $nombre, $marca, $modelo, $precio, $detalles, $unidades, $imagen) {
    echo "<h1>Producto registrado</h1>";
    echo "<p><strong>ID del producto:</strong> {$id_producto}</p>";
    echo "<p><strong>Nombre:</strong> {$nombre}</p>";
    echo "<p><strong>Marca:</strong> {$marca}</p>";
    echo "<p><strong>Modelo:</strong> {$modelo}</p>";
    echo "<p><strong>Precio:</strong> {$precio}</p>";
    echo "<p><strong>Detalles:</strong> {$detalles}</p>";
    echo "<p><strong>Unidades:</strong> {$unidades}</p>";
    echo "<p><strong>Imagen:</strong> {$imagen}</p>";
    echo "<p><strong>Estado:</strong> No eliminado</p>";
}

// Procesar los datos del formulario
$nombre = trim($_POST['nombre'] ?? '');
$marca = trim($_POST['marca'] ?? '');
$modelo = trim($_POST['modelo'] ?? '');
$precio = (float)($_POST['precio'] ?? 0.0);
$detalles = trim($_POST['detalles'] ?? '');
$unidades = (int)($_POST['unidades'] ?? 0);
$imagen = trim($_POST['imagen'] ?? '');

// Validar los campos requeridos
validarCampos($nombre, $marca, $modelo);

// Conectar a la base de datos
$link = conectarBD();

// Verificar si el producto ya existe
if (productoExiste($link, $nombre, $marca, $modelo)) {
    exit('<p>Error: El producto ya está registrado.</p>');
}

// Insertar el nuevo producto y mostrar el resumen
$id_producto = insertarProducto($link, $nombre, $marca, $modelo, $precio, $detalles, $unidades, $imagen);
if ($id_producto) {
    mostrarResumen($id_producto, $nombre, $marca, $modelo, $precio, $detalles, $unidades, $imagen);
} else {
    echo '<p>Error al registrar el producto.</p>';
}

// Cerrar la conexión a la base de datos
$link->close();
?>
