<?php

use MyApi\Products; 

include_once __DIR__.'/myapi/Products.php';

$products = new Products('root', '12345678a', 'marketzone');

$products->list(); // Obtener la lista de productos

echo $products->getResponse(); // Devolver la respuesta en formato JSON
?>
