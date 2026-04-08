<?php
/*● Ejercicio 3 – valor del mundo: API
[https://api.exchangerate-api.com/v4/latest/USD](https://api.exch
angerate-api.com/v4/latest/USD). Crear clase Moneda y mostrar 5 valores
frente al dólar
*/

class Moneda{
    public $name;
    public $valor;

    public function __construct($name,$valor){
        $this-> name = $name;
        $this-> valor = $valor;
    }

    public function getName(){
        return $this-> name;
    }

    public function getValor(){
        return $this-> valor;
    }

}

$url = 'https://api.exchangerate-api.com/v4/latest/USD';
$api = file_get_contents($url);

$data = json_decode($api,true);
$random =  rand(1,count($data["rates"]));

$usd = new Moneda($data["base"],$data["rates"]["USD"]);
$ang = new Moneda("ANG",$data["rates"]["ANG"]);
$ars = new Moneda("ARS",$data["rates"]["ARS"]);
$eur = new Moneda("EUR",$data["rates"]["EUR"]);
$gbp = new Moneda("GBP",$data["rates"]["GBP"]);



echo $usd->getName()." ";
echo $usd->getValor()."<br>";
echo $ang->getName()." ";
echo $ang->getValor()."<br>";
echo $ars->getName()." ";
echo $ars->getValor()."<br>";
echo $eur->getName()." ";
echo $eur->getValor()."<br>";
echo $gbp->getName()." ";
echo $gbp->getValor()."<br>";
