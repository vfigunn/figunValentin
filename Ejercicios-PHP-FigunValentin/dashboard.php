<?php
/*
Ejercicio 20 – Dashboard informativo: Mostrar resumen de clima, una frase
motivadora y precio BTC. Simular un 'dashboard' informativo.
*/

class Crypto {
    public $nombre;
    public $precio;

    public function __construct($nombre, $precio) {
        $this->nombre = $nombre;
        $this->precio = $precio;
    }
};

class Clima {
    public $ciudad;
    public $temperatura;

    public function __construct($ciudad, $temperatura) {
        $this->ciudad = $ciudad;
        $this->temperatura = $temperatura;
    }
}

class Quote{
    public $texto;
    public $autor;

    public function __construct($texto, $autor) {
        $this->texto = $texto;
        $this->autor = $autor;
    }
}

$urlCrypto = 'https://api.coingecko.com/api/v3/simple/price?ids=bitcoin&vs_currencies=usd';

$dataCrypto = json_decode(file_get_contents($urlCrypto), true);
$bitcoin = new Crypto('Bitcoin', $dataCrypto['bitcoin']['usd'] ?? 0);

$urlClima = 'https://wttr.in/Gualeguaychu?format=j1';

$dataClima = json_decode(file_get_contents($urlClima), true);
$clima = new Clima(
    'Gualeguaychú',
    $dataClima['current_condition'][0]['temp_C'] ?? 0
);

$urlQuote = 'https://zenquotes.io/api/quotes';

$dataQuote = json_decode(file_get_contents($urlQuote), true);
$randomNumber = rand(1, count($dataQuote) - 1);
$quote = new Quote(
    $dataQuote[$randomNumber]['q'] ?? '',
    $dataQuote[$randomNumber]['a'] ?? 'Desconocido'
);

echo "<h2>--------------------Dashboard Informativo--------------------</h2>\n";
echo "<p><b>Clima en {$clima->ciudad}: {$clima->temperatura}°C</b></p>";
echo "<h3><b>Frase Motivadora:</b></h3>\n";
echo "<p>\"{$quote->texto}\" - <b>{$quote->autor}</b></p>\n";
echo "<h3><b>Precio de {$bitcoin->nombre}:</b></h3>\n";
echo "<p>\${$bitcoin->precio}</p>\n";

?>