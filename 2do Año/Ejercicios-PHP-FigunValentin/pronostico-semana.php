<?php
/*
Ejercicio 12 – Pronóstico de la semana: API
[https://wttr.in/Gualeguaychu?format=j1](https://wttr.in/Gualegua
ychu?format=j1). Clase Pronostico, mostrar el clima para 3 días.
*/

class Pronostico {
    public $day;
    public $temperature;

    public function __construct($day, $temperature) {
        $this->day = $day;
        $this->temperature = $temperature;
    }
};


$url = 'https://wttr.in/Gualeguaychu?format=j1';

$data = json_decode(file_get_contents($url),true);

$pronosticos = [];
foreach ($data['weather'] as $dia) {
    $pronostico = new Pronostico(
        $dia['date'],
        $dia['avgtempC']
    );
    $pronosticos[] = $pronostico;
}

foreach ($pronosticos as $pronostico) {
    echo "Día: " . $pronostico->day . ", Temperatura: " . $pronostico->temperature . "°C."."<br>";
}

?>