<?php
/*
Ejercicio 17 – Buscador de personajes Rick and Morty: API
rickandmortyapi.com. Clase Buscador, buscar personajes por especie y estado
*/

class Personaje {
    public $nombre;
    public $estado;
    public $especie;

    public function __construct($nombre, $estado, $especie) {
        $this->nombre = $nombre;
        $this->estado = $estado;
        $this->especie = $especie;
    }
}
$url = 'https://rickandmortyapi.com/api/character/?species=';


//Ingresar especie y estado en  el siguiente array. 
$especie_y_estado = ['Human','Alive'];


$data = json_decode(file_get_contents($url.$especie_y_estado[0].'&status='.$especie_y_estado[1]),true);

$personajes = [];

foreach($data["results"] as $p) {
        $personaje = new Personaje($p["name"], $p["status"], $p["species"]);
        $personajes[] = $personaje;
    }


foreach($personajes as $p) {
    echo "<p>" . $p->nombre . " está " . $p->estado . " y es " . $p->especie . "</p>";
}

?>