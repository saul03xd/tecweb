<?php
    use MyApi\Products; 
    
    include_once __DIR__.'/myapi/Products.php';

    $products = New Products('marketzone');

    $products->singleByName($_GET['name']);

    $products->getData();
?>