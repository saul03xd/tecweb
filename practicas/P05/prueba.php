<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Practica 5</title>
</head>
<body>
    <div>
        <strong>Ejercicio número 1</strong>
        <p>Para que una variable en PHP sea válida debe seguir estas reglas:</p>
        <ul>
            <li>Su nombre es sensible a minúsculas y mayúsculas.</li>
            <li>Un nombre válido tiene que empezar con una letra o un guion bajo (underscore), seguido de cualquier número de letras, números y guion bajo.</li>
        </ul>

        <?php
            $var1 = '$_myvar';
            echo htmlspecialchars("$var1 es una variable válida, ya que empieza por el signo de dólar seguido de un guion bajo.");
            echo "<br />";
            
            $var2 = '$_7var';
            echo htmlspecialchars("$var2 es una variable válida, ya que empieza por el signo de dólar seguido de un guion bajo.");
            echo "<br />";
            
            $var3 = 'myvar';
            echo htmlspecialchars("$var3 no es una variable válida, ya que no empieza por el signo de dólar.");
            echo "<br />";
            
            $var4 = '$myvar';
            echo htmlspecialchars("$var4 es una variable válida, ya que empieza por el signo de dólar seguido de una letra.");
            echo "<br />";
            
            $var5 = '$var7';
            echo htmlspecialchars("$var5 es una variable válida, ya que empieza por el signo de dólar seguido de una letra.");
            echo "<br />";
            
            $var6 = '$_element1';
            echo htmlspecialchars("$var6 es una variable válida, ya que empieza por el signo de dólar seguido de un guion bajo.");
            echo "<br />";
            
            $var7 = '$house*5';
            echo htmlspecialchars("$var7 no es una variable válida. Aunque empieza por el signo de dólar, contiene un * y las variables no permiten caracteres especiales.");
            echo "<br />";
            
            // Liberar
            unset($var1, $var2, $var3, $var4, $var5, $var6, $var7);
        ?>

        <strong>Ejercicio número 2</strong>
        <p>
            <?php
                $a = 'ManejadorSQL';
                $b = 'MySQL';
                $c = &$a;
                var_dump($a);
                echo "<br />";
                var_dump($b);
                echo "<br />";
                var_dump($c);
                echo "<br />";

                // Nuevas asignaciones
                $a = 'PHP server';
                $b = &$a;
                var_dump($a);
                echo "<br />";
                var_dump($b);
                echo "<br />";
                var_dump($c);
                echo "<br />";

                echo "En el segundo bloque de asignaciones se cambió el valor de \$a y ahora tiene PHP server. Dado que \$c es una referencia a \$a, \$c también reflejará este nuevo valor.<br /> Y a \$b se le asignó como referencia a \$a, por lo tanto \$a, \$b y \$c deberán tener el mismo valor, que es PHP server.";
                
                // Liberar
                unset($a, $b, $c);
            ?>
        </p>

        <strong>Ejercicio número 3</strong>
        <p>
            <?php
                $a = "PHP5";
                echo htmlspecialchars($a);
                echo "<br />";
                
                $z[] = &$a;
                print_r($z);
                echo "<br />";
                
                $b = "5a versión de PHP";
                echo htmlspecialchars($b);
                echo "<br />";
                
                $c = $b * 10;
                echo htmlspecialchars($c);
                echo "<br />";
                
                $a .= $b;
                echo htmlspecialchars($a);
                echo "<br />";
                
                $b *= $c;
                echo htmlspecialchars($b);
                echo "<br />";
                
                $z[0] = "MySQL";
                print_r($z);
                
                // Liberar
                unset($a, $b, $c, $z);
            ?>
        </p>

        <strong>Ejercicio número 4</strong>
        <p>
            <?php
                $GLOBALS['a'] = "PHP5";
                echo htmlspecialchars($GLOBALS['a']);
                echo "<br />";
                
                $GLOBALS['z'][] = &$GLOBALS['a'];
                print_r($GLOBALS['z']);
                echo "<br />";
                
                $GLOBALS['b'] = "5a versión de PHP";
                echo htmlspecialchars($GLOBALS['b']);
                echo "<br />";
                
                $GLOBALS['c'] = $GLOBALS['b'] * 10;
                echo htmlspecialchars($GLOBALS['c']);
                echo "<br />";
                
                $GLOBALS['a'] .= $GLOBALS['b'];
                echo htmlspecialchars($GLOBALS['a']);
                echo "<br />";
                
                $GLOBALS['b'] *= $GLOBALS['c'];
                echo htmlspecialchars($GLOBALS['b']);
                echo "<br />";
                
                $GLOBALS['z'][0] = "MySQL";
                print_r($GLOBALS['z']);
                
                // Liberar
                unset($GLOBALS['a'], $GLOBALS['b'], $GLOBALS['c'], $GLOBALS['z']);
            ?>
        </p>

        <strong>Ejercicio número 5</strong>
        <p>
            <?php
                $a = "7 personas";
                echo htmlspecialchars($a);
                echo "<br />";
                
                $b = (integer) $a;
                echo htmlspecialchars($b);
                echo "<br />";
                
                $a = "9E3";
                echo htmlspecialchars($a);
                echo "<br />";
                
                $c = (double) $a;
                echo htmlspecialchars($c);
                
                // Liberar
                unset($a, $b, $c);
            ?>
        </p>

        <strong>Ejercicio número 6</strong>
        <p>
            <?php
                $a = "0";
                $b = "TRUE";
                $c = FALSE;
                $d = ($a OR $b);
                $e = ($a AND $c);
                $f = ($a XOR $b);

                var_dump($a, $b, $c, $d, $e, $f);
                echo "<br />";
                
                // Mostrar el valor booleano de $c y $e usando var_export
                echo "Valor de \$c (con var_export): " . var_export($c, true) . "<br />";
                echo "Valor de \$e (con var_export): " . var_export($e, true) . "<br />";
                
                // Liberar 
                unset($a, $b, $c, $d, $e, $f);
            ?>
        </p>

        <strong>Ejercicio número 7</strong>
        <p>
            <?php
                echo "Versión: " . htmlspecialchars($_SERVER['SERVER_SOFTWARE']);
                echo "<br />";
                
                echo "Nombre servidor: " . htmlspecialchars(PHP_OS);
                echo "<br />";
                
                echo "Idioma: " . htmlspecialchars($_SERVER['HTTP_ACCEPT_LANGUAGE']);
            ?>
        </p>
    </div>
</body>
</html>
