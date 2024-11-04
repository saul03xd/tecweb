<?php

// Conectar a la base de datos
@$link = new mysqli('localhost', 'root', '12345678a', 'marketzone');
if ($link->connect_errno) {
    die('Falló la conexión: '.$link->connect_error);
}

// Obtener los valores del formulario
if (isset($_POST['id'])) {
    $id = intval($_POST['id']); // Asegurarse de que es un entero
} else {
    die('Error: No se recibió el ID del producto.');
}

// Escapar datos para prevenir inyecciones SQL
$nombre = $link->real_escape_string($_POST['nombre']);
$marca  = $link->real_escape_string($_POST['marca']);
$modelo = $link->real_escape_string($_POST['modelo']);
$precio = floatval($_POST['precio']); // Asegurarse de que es un valor numérico
$detalles = $link->real_escape_string($_POST['detalles']);
$unidades = intval($_POST['unidades']); // Asegurarse de que es un entero
$eliminado = 0; // Valor fijo

// Ruta por defecto si no se sube una imagen
$defaultImagePath = 'http://localhost/tecweb/practicas/P10/img/img.png';

// Verificar si se ha subido una imagen
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    // Información de la imagen subida
    $nombreImagen = $_FILES['imagen']['name'];
    $tmpImagen = $_FILES['imagen']['tmp_name'];
    
    // Mover la imagen a un directorio en el servidor
    $uploadDir = '../P10/img/'; // Carpeta donde se almacenarán las imágenes
    $rutaImagen = $uploadDir . basename($nombreImagen);

    // Intentar mover el archivo subido al directorio de destino
    if (move_uploaded_file($tmpImagen, $rutaImagen)) {
        echo "La imagen ha sido subida correctamente.";
    } else {
        echo "Error al subir la imagen.";
        $rutaImagen = $defaultImagePath; // Usar la imagen por defecto en caso de error
    }
} else {
    // Si no se ha subido una imagen, usar la ruta por defecto
    $rutaImagen = $defaultImagePath;
}

// Preparar la sentencia SQL para actualizar el registro
$sql = "UPDATE productos SET 
    nombre = '$nombre', 
    marca = '$marca', 
    modelo = '$modelo', 
    precio = $precio, 
    detalles = '$detalles', 
    unidades = $unidades, 
    imagen = '$rutaImagen',  
    eliminado = $eliminado 
    WHERE id = $id;";

// Imprimir la consulta SQL para depuración
echo "Consulta SQL: $sql <br>";

// Ejecutar la consulta
if ($link->query($sql)) {
    // Verificar si se actualizaron filas
    if ($link->affected_rows > 0) {
        echo 'Producto actualizado';
    } else {
        echo 'No se actualizaron filas. Puede que el producto ya tuviera los mismos valores o que no exista un producto con ese ID.';
    }
} else {
    echo 'Error al actualizar el producto: ' . $link->error;
}

// Cerrar la conexión
mysqli_close($link);

?>
