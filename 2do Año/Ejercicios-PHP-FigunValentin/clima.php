<?php
/*● Ejercicio 2 – El tiempo hoy: API
[https://wttr.in/?format=j1](https://wttr.in/Gualeguaychu?format=3)
Crear una clase Clima que muestre temperatura actual y estado. Mostrar el clima en
Gualeguaychú.
*/

class Clima{
    public $estado;
    public $temperatura;

    public function __construct($estado,$temperatura){
        $this-> estado = $estado;
        $this-> temperatura = $temperatura;
    }

    public function getEstado(){
        return $this-> estado;
    }

    public function getTemperatura(){
        return $this-> temperatura;
    }

}

$url = 'https://wttr.in/Gualeguaychu?format=j1';
$api = file_get_contents($url);

$data = json_decode($api,true);

$gualeguaychu = new Clima($data["current_condition"][0]["weatherDesc"][0]["value"],$data["current_condition"][0]["FeelsLikeC"]);


echo "<p> El estado es: ".$gualeguaychu->getEstado()."</p>";
echo "<p> La temperatura es: ".$gualeguaychu->getTemperatura()."</p>";
