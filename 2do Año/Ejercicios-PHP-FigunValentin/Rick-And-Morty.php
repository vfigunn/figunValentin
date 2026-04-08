<?php
/*
Ejercicio 6 – Rick and Morty: Solo humanos vivos: API
[https://rickandmortyapi.com/api/character](https://rickandmortya
pi.com/api/character). Crear clase Personaje y mostrar solo humanos vivos.
*/

class Personaje {
    public $nombre;
    public $estado;

    public function __construct($nombre, $estado) {
        $this->nombre = $nombre;
        $this->estado = $estado;
    }
}

$url = 'https://rickandmortyapi.com/api/character';
$api = file_get_contents($url);

$data = json_decode($api,true);

$personajes = $data["results"];

foreach ($personajes as $p) {
    if ($p["status"] === "Alive" && $p["species"] === "Human") {
        $personaje = new Personaje($p["name"], $p["status"]);
        echo $personaje->nombre . " está " . $personaje->estado . "<br>";
    }
}


?>