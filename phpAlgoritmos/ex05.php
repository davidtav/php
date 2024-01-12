<?php
//filtrar elementos em um array
$numeros = array(3,8,6,1);

$numerosFiltrados = array_filter($numeros,function($valor)
{
    return $valor>5;
});

print_r($numerosFiltrados);