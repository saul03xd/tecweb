<?php
namespace tecweb\MyApi;

abstract class DataBase {
    protected $conexion = NULL;
    
    public function __construct($db='marketzone', $user='root', $pass='12345678a') {
        $this->conexion = @mysqli_connect(
            'localhost',
            $user,
            $pass,
            $db
        );

    }

    public function getData(){
        return json_encode($this->response, JSON_PRETTY_PRINT);
    }
}
?>