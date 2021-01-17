<?php 

	require_once "../../clases/Categorias.php";
    $Categoria = new Categorias();

    echo json_encode($Categoria->obtenerCategoria($_POST['idCategoria']));

 ?>