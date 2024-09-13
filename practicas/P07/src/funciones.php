<?php
function esMultiploDe5Y7($numero) {
    if(isset($numero)) {
        if ($numero % 5 == 0 && $numero % 7 == 0) {
            echo '<h3>R= El número '.$numero.' SÍ es múltiplo de 5 y 7.</h3>';
        } else {
            echo '<h3>R= El número '.$numero.' NO es múltiplo de 5 y 7.</h3>';
        }
    }
}

function generarMatriz($filas) {
    $matriz = [];
    $iteraciones = 0;

    while (count($matriz) < $filas) {
        $num1 = rand(1, 1000); //Genera números aleatorios
        $num2 = rand(1, 1000);
        $num3 = rand(1, 1000);
        $iteraciones++;

        if (($num1 % 2 != 0) && ($num2 % 2 == 0) && ($num3 % 2 != 0)) {
            $matriz[] = [$num1, $num2, $num3];
        }
    }

    echo "Matriz generada:\n";
    echo '<br>';
    foreach ($matriz as $fila) {
        echo implode(', ', $fila) . "\n";
        echo '<br>';
    }
    $totalNumeros = $iteraciones*3;
    echo "$totalNumeros\n números obtenidos en $iteraciones\n iteraciones";

}

function buscarMultiplo($valor){
    if (!empty($valor)){
        $multiploEncontrado = false;

        while(!$multiploEncontrado){
            $randomNum = rand(1, 1000);
            if($randomNum % $valor == 0){
                echo "El número aleatorio $randomNum es múltiplo de $valor".'<br>';
                $multiploEncontrado = true;
            }
        }
    }
}

function obtenerMultiplo($valor){
    if (!empty($valor)){
        $multiploEncontrado = false;
        do {
            $randomNum = rand(1, 1000);
            if($randomNum % $valor == 0){
                echo 'Resultado usando do-while <br>';
                echo "El número aleatorio $randomNum es múltiplo de $valor";
                $multiploEncontrado = true;
            }
        } while (!$multiploEncontrado);
    }
}

?>