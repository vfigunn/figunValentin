<?php
/*
Ejercicio 5 – Crypto Tracker: API
[https://api.coingecko.com/api/v3/simple/price?ids=bitcoin,ethere
um&vs_currencies=usd](https://api.coingecko.com/api/v3/simple/price?ids=bitcoin,ethereum&vs_currencies=usd). Clase CryptoMoneda con
nombre y precio.
*/

class CryptoMoneda {
    public $nombre;
    public $precio;

    public function __construct($nombre, $precio) {
        $this->nombre = $nombre;
        $this->precio = $precio;
    }
}

$url = 'https://api.coingecko.com/api/v3/simple/price?ids=bitcoin,ethereum&vs_currencies=usd';
$api = file_get_contents($url);

$data = json_decode($api,true);


$bitcoin = new CryptoMoneda("Bitcoin", $data["bitcoin"]["usd"]);
$ethereum = new CryptoMoneda("Ethereum", $data["ethereum"]["usd"]);

echo $bitcoin->nombre.": ".$bitcoin->precio;
echo "<br>";
echo $ethereum->nombre.": ".$ethereum->precio;