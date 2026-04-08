<?php
/*
Ejercicio 7 – Comparar clima entre dos ciudades: Clase Ciudad con método
compararTemperatura(). Mostrar cuál es más cálida hoy entre Buenos Aires y
Córdoba
*/

class Ciudad {
    public $nombre;
    public $temperatura;

    public function __construct($nombre, $temperatura) {
        $this->nombre = $nombre;
        $this->temperatura = $temperatura;
    }

    public function compararTemperatura($otraCiudad) {
        return $this->temperatura - $otraCiudad->temperatura;
    }
}

$url_Cordoba = 'https://wttr.in/Cordoba+Argentina?format=j1';
$api_Cordoba = file_get_contents($url_Cordoba);
$data_Cordoba = json_decode($api_Cordoba,true);
$cordoba = new Ciudad("Córdoba", $data_Cordoba["current_condition"][0]["FeelsLikeC"]);

$url_Buenos_Aires = 'https://wttr.in/Buenosaires?format=j1';
$api_Buenos_Aires = file_get_contents($url_Buenos_Aires);
$data_Buenos_Aires = json_decode($api_Buenos_Aires,true);
$buenos_aires = new Ciudad("Buenos Aires", $data_Buenos_Aires["current_condition"][0]["FeelsLikeC"]);

if ($cordoba->compararTemperatura($buenos_aires) > 0) {
    echo "La temperatura en Córdoba: ".$cordoba->temperatura. " es mayor a la de Buenos Aires: ".$buenos_aires->temperatura."." ;
} elseif ($cordoba->compararTemperatura($buenos_aires) < 0) {
    echo "La temperatura en Buenos Aires: ".$buenos_aires->temperatura." es mayor a la de Córdoba: ".$cordoba->temperatura.".";
} else {
    echo "Ambas ciudades tienen la misma temperatura.";
}



?>