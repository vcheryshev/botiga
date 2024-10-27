<?php
class Producte
{


    private $nom;
    private $descripcio;
    private $preu;

    private $categoria;

    function __construct($name, $descripcio, $preu, $categoria) {
        $this->nom = $name;
        $this->descripcio = $descripcio;
        $this->preu = $preu;
        if($this->categoria != ""){
            $this->categoria = $categoria;
        }
    }

    function get_nom() {
        return $this->nom;
    }
    function get_categoria() {
        return $this->categoria;
    }
    function get_preu() {
        return $this->preu;
    }

    function get_desc() {
        return $this->descripcio;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }


}

class Categoria
{
    private $nom;
    private $descripcio;

    function __construct($name, $descripcio) {
        $this->nom = $name;
        $this->descripcio = $descripcio;

    }

    function get_nom() {
        return $this->nom;
    }

    function get_descripcio() {
        return $this->descripcio;
    }
}



function crearProducte($nom, $descripcio, $preu) {

    $producte = new Producte($nom, $descripcio, $preu, "");

    //$conexion=new Conexion();
    return $producte;


}

function crearCategoria($nom, $descripcio) {

    return $categoria = new Categoria($nom, $descripcio);


}

function agregarCategoriaAProducte($producte, $categoria) {

        $name =$categoria->get_nom();
        $producte->setCategoria($name);

}

function obtenirProductsPorCategoria($categoria) {
    $jsonData  = file_get_contents("productes.json");
    $data = json_decode($jsonData, true);



    echo  "<br>" ." Productes de la categoria " .$categoria->get_nom() . "<br>";
    foreach ($data as $key => $value) {
        if($value["Categoria"] == $categoria->get_nom()){
            echo  "<br>" .$key ." " ."Nombre Producto: " .$value["Nombre Producto"] . "<br>" ." Descripcion: " .$value["Descripcion"]
                . "<br>" ." Precio: " .$value["Precio"] . "<br>" ." Categoria: " .$value["Categoria"] . "<br>";
        }

    }

}

function mostrarProductes($productes) {

    $jsonData  = file_get_contents("productes.json");
    $data = json_decode($jsonData, true);

    echo  "<br>" ."Tots els productes" . "<br>";

    foreach ($data as $key => $value) {

        echo  "<br>" .$key ." " ."Nombre Producto: " .$value["Nombre Producto"] . "<br>" ." Descripcion: " .$value["Descripcion"]
            . "<br>" ." Precio: " .$value["Precio"] . "<br>" ." Categoria: " .$value["Categoria"] . "<br>";

    }
}



// Esta de momento no la estoy utilizando
function guardarProductoEnMemoria($producto){

    // Primero compruebo si el json está creado en memoria
    try{
        // El @ lo utilizo porque a pesar de que hago try y catch me sale el warning y queda to feo así que con el @ suprimo los warnings
        // lanzo una excepción controlada
        $jsonData  = @file_get_contents("productes.json");
        if($jsonData ==null){
            throw new Exception("El json no está creado así que creo uno ");
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }

    // Si no está creado lo creo
    if($jsonData==null){
        $jsonArray=[];
        $json= json_encode($jsonArray, JSON_PRETTY_PRINT);
        file_put_contents("productes.json", $json);
        $data = json_decode($jsonData, true);

        $nuevoProducto=[
            "Nombre Producto"=> $producto->get_Nom(),
            "Descripcion"=> $producto->get_desc(),
            "Precio"=> $producto->get_preu(),
            "Categoria"=> $producto->get_categoria()
        ];

        $data[]=$nuevoProducto;
        $jsonActualizado = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents("productes.json", $jsonActualizado);

        echo "<br>"."Json creado con su producto";
    }else{
        // Si el json está creado simplemente lo actualizamos
        $data = json_decode($jsonData, true);

        $nuevoProducto=[
            "Nombre Producto"=> $producto->get_Nom(),
            "Descripcion"=> $producto->get_desc(),
            "Precio"=> $producto->get_preu(),
            "Categoria"=> $producto->get_categoria()
        ];

        $data[]=$nuevoProducto;
        $jsonActualizado = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents("productes.json", $jsonActualizado);
        echo "Json actualizado con su producto";

    }

}

function guardarCategoriaEnMemoria($categoria){
    // Primero compruebo si el json está creado en memoria
    try{
        // El @ lo utilizo porque a pesar de que hago try y catch me sale el warning y queda to feo así que con el @ suprimo los warnings
        // lanzo una excepción controlada
        $jsonData  = @file_get_contents("categories.json");
        if($jsonData ==null){
            throw new Exception("El json no está creado así que creo uno ");
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }

    // Si no está creado lo creo
    if($jsonData==null){
        $jsonArray=[];
        $json= json_encode($jsonArray, JSON_PRETTY_PRINT);
        file_put_contents("categories.json", $json);
        $data = json_decode($jsonData, true);

        $nuevaCat=[
            "Nombre Categoria"=> $categoria->get_Nom(),
            "Descripcion"=> $categoria->get_desc()
        ];

        $data[]=$nuevaCat;
        $jsonActualizado = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents("categories.json", $jsonActualizado);
        echo "<br>"."Json creado con su categoria";

    }else{
        // Si el json está creado simplemente lo actualizamos
        $data = json_decode($jsonData, true);
        $nuevaCat=[
            "Nombre Categoria"=> $categoria->get_Nom(),
            "Descripcion"=> $categoria->get_descripcio()
        ];

        $data[]=$nuevaCat;
        $jsonActualizado = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents("categories.json", $jsonActualizado);
        echo "Json actualizado con su categoria";

    }

}

?>
