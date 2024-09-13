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

    <h2>Ejercicio 3</h2>
    <p>Utiliza un ciclo while para encontrar el primer número entero obtenido aleatoriamente, 
    pero que además sea múltiplo de un número dado.<p>
    <?php
        buscarMultiplo($_GET['numero']);
        obtenerMultiplo($_GET['numero']);
    ?>

    <h2>Ejercicio 4</h2>
    <p>Arreglo cuyos valores son valores de la 'a' a la 'z'<p>
    <?php
        generarTablaLetras(3);
    ?>


    <h2>Ejercicio 5 formulario</h2>
    <form action="procesar.php" method="POST">
        <label for="edad">Edad:</label>
        <input type="number" name="edad" id="edad" required /><br />

        <label for="sexo">Sexo:</label>
        <select name="sexo" id="sexo" required>
            <option value="">Seleccione su sexo</option>
            <option value="femenino">Femenino</option>
            <option value="masculino">Masculino</option>
        </select><br />

        <input type="submit" value="Enviar" />
    </form>

    <h2>Ejercicio 6 autos</h2>

    <form action="vehiculos.php" method="post">
        <fieldset>
            <legend>Consultar por Matrícula</legend>
            <label for="matricula">Matrícula:</label>
            <input type="text" id="matricula" name="matricula" required>
            <button type="submit">Consultar</button>
        </fieldset>
    </form>

    <form action="vehiculos.php" method="post">
        <fieldset>
            <legend>Ver Todos los Vehículos</legend>
            <button type="submit" name="verTodos">Ver Todos</button>
        </fieldset>
    </form>
</body>
</html>