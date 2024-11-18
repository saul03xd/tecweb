<?php

namespace backend\myapi;

require_once 'DataBase.php';

class Products extends DataBase
{
    private $response;

    public function __construct($user = 'root', $pass = '12345678a', $db = 'marketzone') {
        parent::__construct($user, $pass, $db);
    }

    public function add($product)
    {
        $nombre = $this->conexion->real_escape_string($product['nombre']);
        $marca = $this->conexion->real_escape_string($product['marca']);
        $modelo = $this->conexion->real_escape_string($product['modelo']);
        $precio = $this->conexion->real_escape_string($product['precio']);
        $detalles = $this->conexion->real_escape_string($product['detalles'] ?? '');
        $unidades = $this->conexion->real_escape_string($product['unidades']);
        $imagen = $this->conexion->real_escape_string($product['imagen'] ?? '');

        $sqlCheck = "SELECT * FROM productos WHERE nombre = '$nombre' AND eliminado = 0";
        $result = $this->conexion->query($sqlCheck);

        if ($result->num_rows === 0) {
            $sqlInsert = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado) VALUES ('$nombre', '$marca', '$modelo', $precio, '$detalles', $unidades, '$imagen', 0)";
            if ($this->conexion->query($sqlInsert)) {
                $this->response = ['status' => 'success', 'message' => 'Producto agregado exitosamente'];
            } else {
                $this->response = ['status' => 'error', 'message' => "Error al ejecutar la consulta: " . $this->conexion->error];
            }
        } else {
            $this->response = ['status' => 'error', 'message' => 'Ya existe un producto con ese nombre'];
        }

        $result->free();
    }

    public function delete($id)
    {
        $id = intval($id);
        $sql = "UPDATE productos SET eliminado=1 WHERE id = $id";
        if ($this->conexion->query($sql)) {
            $this->response = ['status' => 'success', 'message' => 'Producto eliminado'];
        } else {
            $this->response = ['status' => 'error', 'message' => "ERROR: No se ejecuto $sql. " . $this->conexion->error];
        }
    }

    public function edit($product)
    {
        $id = $this->conexion->real_escape_string($product['id']);
        $nombre = $this->conexion->real_escape_string($product['nombre']);
        $marca = $this->conexion->real_escape_string($product['marca']);
        $modelo = $this->conexion->real_escape_string($product['modelo']);
        $precio = $this->conexion->real_escape_string($product['precio']);
        $detalles = $this->conexion->real_escape_string($product['detalles'] ?? '');
        $unidades = $this->conexion->real_escape_string($product['unidades']);
        $imagen = $this->conexion->real_escape_string($product['imagen'] ?? '');

        $sql = "UPDATE productos SET nombre = '$nombre', marca = '$marca', modelo = '$modelo', precio = $precio, detalles = '$detalles', unidades = $unidades, imagen = '$imagen' WHERE id = '$id' AND eliminado = 0";

        if ($this->conexion->query($sql)) {
            $this->response = ['status' => 'success', 'message' => 'Producto actualizado exitosamente'];
        } else {
            $this->response = ['status' => 'error', 'message' => "Error al ejecutar la consulta: " . $this->conexion->error];
        }
    }

    public function list()
    {
        $data = [];

        if ($result = $this->conexion->query("SELECT * FROM productos WHERE eliminado = 0")) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            foreach ($rows as $num => $row) {
                foreach ($row as $key => $value) {
                    $data[$num][$key] = utf8_encode($value);
                }
            }
            $result->free();
        } else {
            die('Query Error: ' . $this->conexion->error);
        }

        $this->response = $data;
    }

    public function search($search)
    {
        $data = [];
        $search = $this->conexion->real_escape_string($search);
        $sql = "SELECT * FROM productos WHERE (id = '$search' OR nombre LIKE '%$search%' OR marca LIKE '%$search%' OR detalles LIKE '%$search%') AND eliminado = 0";
        if ($result = $this->conexion->query($sql)) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            foreach ($rows as $num => $row) {
                foreach ($row as $key => $value) {
                    $data[$num][$key] = utf8_encode($value);
                }
            }
            $result->free();
        } else {
            die('Query Error: ' . $this->conexion->error);
        }

        $this->response = $data;
    }

    public function single($id)
    {
        $data = ['status' => 'error', 'message' => 'No se encontró el producto'];
        $id = intval($id);
        $sql = "SELECT * FROM productos WHERE id = $id AND eliminado = 0";
        if ($result = $this->conexion->query($sql)) {
            if ($result->num_rows > 0) {
                $producto = $result->fetch_assoc();
                foreach ($producto as $key => $value) {
                    $data['producto'][$key] = utf8_encode($value);
                }
                $data['status'] = 'success';
                $data['message'] = 'Producto encontrado';
            } else {
                $data['message'] = 'Producto no encontrado';
            }
        } else {
            die('Query Error: ' . $this->conexion->error);
        }

        $this->response = $data;
    }

    public function singleByName($name)
    {
        $data = ['status' => 'error', 'message' => 'No se encontró el producto'];
        $name = $this->conexion->real_escape_string($name);
        $sql = "SELECT * FROM productos WHERE nombre = '$name' AND eliminado = 0";
        if ($result = $this->conexion->query($sql)) {
            if ($result->num_rows > 0) {
                $producto = $result->fetch_assoc();
                foreach ($producto as $key => $value) {
                    $data['producto'][$key] = utf8_encode($value);
                }
                $data['status'] = 'success';
                $data['message'] = 'Producto encontrado';
            } else {
                $data['message'] = 'Producto no encontrado';
            }
        } else {
            die('Query Error: ' . $this->conexion->error);
        }

        $this->response = $data;
    }

    public function getData()
    {
        return json_encode($this->response, JSON_PRETTY_PRINT);
    }
}
?>
