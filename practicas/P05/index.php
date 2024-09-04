<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        echo "<b>Ejercicio numero 1</b>";
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
        // Liberar
        unset($var1, $var2, $var3, $var4, $var5, $var6, $var7);

        echo '<br>';
        echo "<b>Ejercicio numero 2</b>";
        echo '<br> <br>';
        $a = 'ManejadorSQL';
        $b = 'MySQL';
        $c = &$a;
        var_dump($a);
        echo '<br>';
        var_dump($b);
        echo '<br>';
        var_dump($c);
        echo '<br>';
        
        //nuevas asignaciones
        $a = 'PHP server';
        $b = &$a;
        var_dump($a);
        echo '<br>';
        var_dump($b);
        echo '<br>';
        var_dump($c);
        echo '<br>';
        echo "En el segundo bloque de asignaciones se cambio el valor de a y ahora tiene PHP server, Dado que c es una referencia a a, c también reflejará este nuevo valor.
        <br> y a b se le asigno como referencia a a por lo tanto a, b y c deberan de tomar el mismo valor que a y este es PHP server";
        // Liberar
        unset($a, $b, $c);
        echo '<br>';
        
        echo '<br>';
        echo "<b>Ejercicio numero 3</b>";
        echo '<br> <br>';
        $a = "PHP5";
        echo "$a";
        echo '<br>';
        $z[] = &$a;
        print_r($z) ;
        echo "<br>";
        $b = "5a version de PHP";
        echo "$b";
        echo '<br>';
        $c = $b * 10;
        echo "$c";
        echo '<br>';
        $a .= $b;
        echo "$a";
        echo '<br>';
        $b *= $c;
        echo "$b";
        echo '<br>';
        $z[0] = "MySQL";
        print_r($z) ;
        // Liberar
        unset($a, $b, $c, $z);
        echo '<br>';

        echo '<br>';
        echo "<b>Ejercicio numero 4</b>";
        echo '<br> <br>';
        $GLOBALS['a'] = "PHP5";
        echo $GLOBALS['a'];
        echo '<br>';
        $GLOBALS['z'][] = &$GLOBALS['a'];
        print_r($GLOBALS['z']);
        echo "<br>";
        $GLOBALS['b'] = "5a version de PHP";
        echo $GLOBALS['b'];
        echo '<br>';
        $GLOBALS['c'] = $GLOBALS['b'] * 10;
        echo $GLOBALS['c'];
        echo '<br>';
        $GLOBALS['a'] .= $GLOBALS['b'];
        echo $GLOBALS['a'];
        echo '<br>';
        $GLOBALS['b'] *= $GLOBALS['c'];
        echo $GLOBALS['b'];
        echo '<br>';
        $GLOBALS['z'][0] = "MySQL";
        print_r($GLOBALS['z']);
        // Liberar
        unset($GLOBALS['a'], $GLOBALS['b'], $GLOBALS['c'], $GLOBALS['z']);
        echo '<br>'
?>
</body>
</html>