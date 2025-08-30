<?php
/*
Ejercicio 11 – Pokémon filtrado por tipo: API
[https://pokeapi.co/api/v2/pokemon?limit=10](https://pokeapi.co/a
pi/v2/pokemon?limit=10). Filtrar pokémon de tipo fuego.
*/

class Pokemon {
    public $name;
    public $type;


    public function __construct($name, $type) {
        $this->name = $name;
        $this->type = $type;
    }
};

$pokemones = [];

$url = 'https://pokeapi.co/api/v2/pokemon/';

for ($i = 1; $i <= 10; $i++) {
    $data = json_decode(file_get_contents($url . $i), true);
    $tipo = $data["types"][0]["type"]["name"] ?? '';
    $pokemon = new Pokemon($data["name"], $tipo);
    $pokemones[] = $pokemon;
}

$pokemones_fuego = array_filter($pokemones, function($pokemon) {
    return $pokemon->type === 'fire';
});

echo "<h2>Pokémones de tipo fuego:</h2>";
foreach ($pokemones_fuego as $pokemon) {
    echo "Nombre: " . $pokemon->name . ", Tipo: " . $pokemon->type . "<br>";
}



?>