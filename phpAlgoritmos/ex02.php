<?php
//retirar um item em um array
$frutas = array("maça", "banana", "morango", "Uva");

$retirarFruta = "banana";
$chave = array_search($retirarFruta, $frutas);

if ($chave !== false) {
    unset($frutas[$chave]);
}
print_r($frutas);
