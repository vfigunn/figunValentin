<?php
/*
Ejercicio 4 – Noticias del día (sin API): Simular una clase Noticia con datos
cargados desde un archivo JSON o array. Mostrar las 3 más recientes.
*/

class Noticia {
    public $titulo;
    public $noticia;
    public $fecha;

    public function __construct($titulo, $noticia, $fecha) {
        $this->titulo = $titulo;
        $this->noticia = $noticia;
        $this->fecha = new DateTime($fecha);
    }
}

$datos = [
    ["titulo" => "PHP 8.3 lanzado", "noticia" => "La nueva version de PHP ya está disponible.", "fecha" => "2025-08-21"],
    ["titulo" => "IA revoluciona la programacion", "noticia" => "Los programadores usan IA para acelerar tareas.", "fecha" => "2025-08-20"],
    ["titulo" => "Nuevo framework web", "noticia" => "Se presenta un framework rápido y seguro.", "fecha" => "2025-08-19"],
    ["titulo" => "Hackathon global", "noticia" => "Miles de desarrolladores compiten en linea.", "fecha" => "2025-08-18"],
    ["titulo" => "Ciberseguridad en 2025", "noticia" => "Nuevas amenazas aparecen en el mundo digital.", "fecha" => "2025-08-17"]
];

$noticias = [];

foreach ($datos as $dato) {
    $noticias[] = new Noticia($dato["titulo"], $dato["noticia"], $dato["fecha"]);
}

usort($noticias, function($a, $b) {
    return $b->fecha <=> $a->fecha;
});

$noticiasRecientes = array_slice($noticias, 0, 3);

foreach ($noticiasRecientes as $noticia) {
    echo "<h2>{$noticia->titulo}</h2>";
    echo "<p>{$noticia->noticia}</p>";
    echo "<small>Fecha: {$noticia->fecha->format('Y-m-d')}</small>";
}

?>