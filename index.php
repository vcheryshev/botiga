<?php

use function Sodium\add;

require_once 'funcions.php';

// Dades inicials (exemple)

$productes=[];


// Cojo los datos de Index.html para crear los productos
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['nombre'], $_POST['descripcion'], $_POST['precio'], $_POST['categorias'])) {
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $precio=$_POST['precio'];
        $Nomcategoria = $_POST['categorias'];
        $producte=crearProducte($nombre, $descripcion, $precio);
        $categoria=crearCategoria($Nomcategoria, "");
        agregarCategoriaAProducte($producte, $categoria);
        //array_push($productes, $producte);
        guardarProductoEnMemoria($producte);
    }

    if (isset($_POST['buscar_categoria'])) {
        $categoriaSeleccionada = $_POST['buscar_categoria'];
        $categoria=crearCategoria($categoriaSeleccionada, "");
        if ($categoriaSeleccionada) {
            obtenirProductsPorCategoria($categoria);
        }

        if($categoriaSeleccionada=="Todas"){
            mostrarProductes($productes);
        }
    }
}

//$categoria=crearCategoria("hola", "");

//guardarCategoriaEnMemoria($categoria);




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gestio Botiga</title>
    <link rel="stylesheet" href="Styles.css">
</head>
<body>
<!-- Aquí van tus formularios y lógica de PHP -->

<!-- Botón para volver al formulario HTML -->
<form action="index.html" method="get">
    <input type="submit" value="Volver" style="margin-top: 20px;">
</form>
</body>
</html>
