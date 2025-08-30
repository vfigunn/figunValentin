<?php
/*
Ejercicio 16 – Combinar clima + actividad: Si el clima es soleado, mostrar actividad al
aire libre. Si llueve, una actividad indoor. Combinar APIs de clima + boredapi.
*/

class Actividad {
    public $activity;


    public function __construct($activity) {
        $this->activity = $activity ;
    }
};

class Clima {
    public $temperatura;
    public $condicion;

    public function __construct($temperatura, $condicion) {
        $this->temperatura = $temperatura;
        $this->condicion = $condicion;
    }
}

$bored_education = 'https://bored-api.appbrewery.com/filter?type=education';
$bored_social = 'https://bored-api.appbrewery.com/filter?type=social';

$clima = 'https://wttr.in/Gualeguaychu?format=j1';

$data_education = json_decode(file_get_contents($bored_education), true);
$data_social = json_decode(file_get_contents($bored_social), true);
$data_clima = json_decode(file_get_contents($clima), true);

$temperatura = $data_clima['current_condition'][0]['temp_C'];
$condicion = $data_clima["current_condition"][0]["weatherDesc"][0]["value"];

$actividad = null;

if ($condicion === 'Soleado') {
    $actividad = new Actividad($data_education['activities'][0]);
} else {
    $actividad = new Actividad($data_social['activities'][0]);
}

echo "<h2>Clima Actual:</h2>";
echo "Temperatura: " . $temperatura . "°C<br>";
echo "Condición: " . $condicion . "<br>";

echo "<h2>Actividad Sugerida:</h2>";
echo $actividad->activity;

?>