<?php 
class conectar{
    public function conexion(){
        $servidor = "localhost";
        $usuario = "root";
        $password = "";
        $baseDatos = "gestor";
        $conexion = mysqli_connect($servidor, 
            $usuario, 
            $password, 
            $baseDatos);
        return $conexion;
    }
}
?>