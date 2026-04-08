<?php
/*
Ejercicio 9 – Actividad solar: API
[https://api.le-systeme-solaire.net/rest/bodies/](https://api.lesysteme-solaire.net/rest/bodies/). Clase CuerpoCeleste, mostrar los 3
planetas más grandes
*/

class CuerpoCeleste {
    public $nombre;
    public $meanRadius;

    public function __construct($nombre, $meanRadius) {
        $this->nombre = $nombre;
        $this->meanRadius = $meanRadius;
    }
};

$url = 'https://api.le-systeme-solaire.net/rest/bodies/';

$data = json_decode(file_get_contents($url), true);

$planetas = $data["bodies"];

$cuerposCelestes = [];

foreach($planetas as $planeta){
    $nombre = $planeta["englishName"];
    $meanRadius = $planeta["meanRadius"];
    $cuerposCelestes[] = new CuerpoCeleste($nombre, $meanRadius);
}

usort($cuerposCelestes, function($a, $b) {
    return $b->meanRadius - $a->meanRadius;
});

$tres_mas_grandes = array_slice($cuerposCelestes, 0, 3);

foreach ($tres_mas_grandes as $planeta) {
    echo "Nombre: " . $planeta->nombre . ", Radio medio: " . $planeta->meanRadius . " km"."<br>";
}

?>