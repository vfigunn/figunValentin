<?php
/*
Ejercicio 19 – Ranking de países por población: API
[https://restcountries.com/v3.1/all](https://restcountries.com/v3
.1/all). Clase Pais, mostrar top 5 países con más población.
*/

class Pais {
    public $nombre;
    public $poblacion;

    public function __construct($nombre, $poblacion) {
        $this->nombre = $nombre;
        $this->poblacion = $poblacion;
    }
}

$url = 'https://restcountries.com/v3.1/all?fields=name,population';

$data = json_decode(file_get_contents($url), true);

$paises = [];

foreach ($data as $pais) {
    $nombre = $pais['name']['common'] ?? 'Desconocido';
    $poblacion = $pais['population'] ?? 0;
    $paises[] = new Pais($nombre, $poblacion);
}

usort($paises, fn($a, $b) => $b->poblacion <=> $a->poblacion);
$top5 = array_slice($paises, 0, 5);

echo "<h2>Top 5 países con mayor población</h2>";
foreach ($top5 as $pais) {
    echo "<p><b>" . $pais->nombre . "</b> tiene una población de " . number_format($pais->poblacion) . " personas.</p>";
}

?>