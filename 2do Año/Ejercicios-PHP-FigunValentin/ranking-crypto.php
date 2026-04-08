<?php
/*
Ejercicio 14 – Ranking de criptos: API
[https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd](
https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd).
Mostrar top 5 por precio.
*/

class Crypto {
    public $name;
    public $price;

    public function __construct($name, $price) {
        $this->name = $name;
        $this->price = $price;
    }
};

$url = 'https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd';

$data = json_decode(file_get_contents($url),true);


if (!is_array($data)) {
    echo "Error al obtener datos de la API.";
    exit;
}
print_r($data);

$cryptos = [];

foreach ($data as $coin) {
    $name = $coin['name'];
    $price = $coin['current_price'];
    
    $crypto = new Crypto(
        $name,
        $price
    );

    $cryptos[] = $crypto;
}

usort($cryptos, function($a, $b) {
    return $b->price <=> $a->price;
});

$top_5 = array_slice($cryptos, 0, 5);
foreach ($top_5 as $crypto) {
    echo "Cripto: " . $crypto->name . ", Precio: " . $crypto->price . " USD."."<br>";
}




?>