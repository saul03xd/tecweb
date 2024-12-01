<?php
namespace MyApi;

abstract class DataBase {
    protected $conexion = NULL;
    
    public function __construct($db, $user, $pass) {
        $this->conexion = @mysqli_connect(
            'localhost',
            $user,
            $pass,
            $db
        );

    }
}
?>