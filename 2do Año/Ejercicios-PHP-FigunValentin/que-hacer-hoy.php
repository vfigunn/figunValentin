<?php
/*
Ejercicio 10 – Qué hacer hoy: API
[https://www.boredapi.com/api/activity](https://www.boredapi.com/
api/activity). Clase Actividad. Armar una rutina con 3 actividades sugeridas.
*/

class Actividad {
    public $activity;


    public function __construct($activity) {
        $this->activity = $activity ;
    }
};

$url = 'https://bored-api.appbrewery.com/random';

$actividades_sugeridas = [];

for ($i = 0; $i < 3; $i++) {
    $data = json_decode(file_get_contents($url), true);
    $actividad = new Actividad($data["activity"]);
    $actividades_sugeridas[] = $actividad;
}

echo "<h2>Actividades Sugeridas:</h2>";
foreach ($actividades_sugeridas as $index => $actividad) {
    echo "Actividad " . ($index + 1) . ": " . $actividad->activity . "<br>";
}


?>