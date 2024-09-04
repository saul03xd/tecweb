<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        echo "Ejercicio numero 1";
        echo '<br> <br>';

        echo "Para que una variable en PHP sea valida debe de seguir estas reglas <br>
        ◦Su nombre es sensible a minúsculas y mayúsculas. <br>
        ◦Un nombre válido tiene que empezar con una letra o un guion bajo (underscore), seguido de cualquier
         número de letras, números y guion bajo.";
        echo '<br>';
        $var1 = '$_myvar';
        echo '<br>';
        echo "$var1 Es una varaible valida, ya que empieza por el signo de dolar seguido de un guion bajo.";
        echo '<br>';
        $var2 = '$_7var';
        echo "$var2 Es una varaible valida, ya que empieza por el signo de dolar seguido de un guion bajo.";
        echo '<br>';
        $var3 = 'myvar';
        echo "$var3 No es una varaible valida, ya que no empieza por el signo de dolar.";
        echo '<br>';
        $var4 = '$myvar';
        echo "$var4 Es una varaible valida, ya que empieza por el signo de dolar seguido de una letra";
        echo '<br>';
        $var5 = '$var7';
        echo "$var5 Es una varaible valida, ya que empieza por el signo de dolar seguido de una letra";
        echo '<br>';
        $var6 = '$_element1';
        echo "$var6 Es una varaible valida, ya que empieza por el signo de dolar seguido de un guion bajo";
        echo '<br>';
        $var7 = '$house*5';
        echo "$var7 No es una varaible valida, Aunque empieza por el signo de dolar pero tiene un * y en las variables no se permiten caracteres especiales";
        echo '<br>';

?>
</body>
</html>
