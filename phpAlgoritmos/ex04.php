<?php
//extrair elemento em um array
$frutas = array("Maça", "Banana", "Morango", "Uva");
$frutasSelecionadas =array_slice($frutas,1,2);


print_r($frutasSelecionadas);
