<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 4</title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Escribir programa para comprobar si un número es un múltiplo de 5 y 7</p>
    <?php
        include 'src/funciones.php';
        esMultiploDe5Y7($_GET['numero']);
    ?>

    <h2>Ejercicio 2</h2>
    <p>Secuencia de números aleatorios<p>
    <?php
        generarMatriz(3);
    ?>
</body>
</html>