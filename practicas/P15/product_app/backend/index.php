<?php

use tecweb\MyApi\READ\Read; 
use tecweb\MyApi\UPDATE\Update;
use tecweb\MyApi\DELETE\Delete; 
use tecweb\MyApi\CREATE\Create;

require '../vendor/autoload.php';

$app = new Slim\App();

// Ruta principal
$app->get('/', function ($request, $response, $args) {
    return $response->withJson(["message" => "Bienvenido al API RESTful"], 200);
});

// Obtener un producto por nombre
$app->get('/product/name/{name}', function ($request, $response, $args) {
    $products = new Read('marketzone');
    $products->singleByName($args['name']);
    return $response->withJson($products->getData());
});

// Obtener un producto por ID
$app->get('/product/{id}', function ($request, $response, $args) {
    $products = new Read('marketzone');
    $products->single($args['id']);
    return $response->withJson($products->getData());
});

// Verificar si un nombre de producto existe
$app->get('/product/exists/{name}', function ($request, $response, $args) {
    include_once __DIR__.'/../myapi/database.php';
    $name = mysqli_real_escape_string($conn, $args['name']);
    $id = $request->getQueryParam('id', null);
    if ($id) {
        $query = "SELECT COUNT(*) as count FROM productos WHERE nombre='$name' AND id != '$id'";
    } else {
        $query = "SELECT COUNT(*) as count FROM productos WHERE nombre='$name'";
    }
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    return $response->withJson(['exists' => $data['count'] > 0]);
});

// Buscar productos
$app->get('/products/search', function ($request, $response, $args) {
    $products = new Read('marketzone');
    $search = $request->getQueryParam('search', '');
    $products->search($search);
    return $response->withJson($products->getData());
});

// Listar productos
$app->get('/products', function ($request, $response, $args) {
    $products = new Read('marketzone');
    $products->list();
    return $response->withJson($products->getData());
});

// Actualizar un producto
$app->put('/product', function ($request, $response, $args) {
    $products = new Update('marketzone');
    $products->edit($request->getBody());
    return $response->withJson($products->getData());
});

// Eliminar un producto
$app->delete('/product', function ($request, $response, $args) {
    $p = new Delete('marketzone');
    $id = $request->getParsedBody()['id'];
    if ($id) {
        $p->delete($id);
        return $response->withJson($p->getData());
    } else {
        return $response->withJson(['status' => 'error', 'message' => 'ID no proporcionado'], 400);
    }
});

// Crear un nuevo producto
$app->post('/product', function ($request, $response, $args) {
    $products = new Create('marketzone');
    $products->add($request->getBody());
    return $response->withJson($products->getData());
});

$app->run();
?>