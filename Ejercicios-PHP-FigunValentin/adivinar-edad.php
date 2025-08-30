<?php
/*
Ejercicio 8 – Adivina la edad: API
[https://api.agify.io?name=michael](https://api.agify.io?name=mic
hael). Clase Persona con nombre y edad estimada. Mostrar el más longevo.
*/

class Persona {
    public $nombre;
    public $edad;

    public function __construct($nombre, $edad) {
        $this->nombre = $nombre;
        $this->edad = $edad;
    }
};

$urls = ['https://api.agify.io/?name=lucia', 'https://api.agify.io/?name=michael','https://api.agify.io/?name=matias'];

$personas = [];

foreach ($urls as $url) {
    $data = json_decode(file_get_contents($url), true);
    $nombre = $data['name'];
    $edad = $data['age'];
    $personas[] = new Persona($nombre, $edad);
}

$persona_mas_longeva = null;
$edad_mas_alta = 0;

foreach ($personas as $persona) {
    if ($persona->edad > $edad_mas_alta) {
        $persona_mas_longeva = $persona;
        $edad_mas_alta = $persona->edad;
    }
}

if ($persona_mas_longeva !== null) {
    echo "La persona más longeva es " . $persona_mas_longeva->nombre . " con " . $persona_mas_longeva->edad . " años.";
}

?>