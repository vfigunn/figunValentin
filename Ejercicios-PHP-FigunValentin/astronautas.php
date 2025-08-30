<?php
/* Ejercicio 1 – Hola desde el espacio: Usar la API
[http://api.open-notify.org/astros.json](http://api.open-notify.o
rg/astros.json). Crear un
*/

class Astronauta{
    public $nombre;
    public $nave;

    public function __construct($nombre,$nave){
        $this-> nombre = $nombre;
        $this-> nave = $nave;
    }

    public function getNombre(){
        return $this-> nombre;
    }

    public function getNave(){
        return $this-> nave;
    }

}

$url = 'http://api.open-notify.org/astros.json';
$api = file_get_contents($url);

$api_data = json_decode($api,true);

foreach($api_data["people"] as $persona){
    $astrounauta = new Astronauta($persona["name"],$persona["craft"]);

    echo "<p> <b>Nombre</b>: ".$astrounauta->getNombre()." | <b>Nave</b>: ".$astrounauta->getNave()."</p>";
}