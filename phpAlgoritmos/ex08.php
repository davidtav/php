<?php 
//filas e pilhas na estrutura de dados
//pilha = ultimo que entra é o primeiro que sai
$pilha = array();
array_push($pilha,"Elemento 1");
array_push($pilha,"Elemento 2");
array_push($pilha,"Elemento 3");
array_push($pilha,"Elemento 4");
array_push($pilha,"Elemento 5");

$elemento = array_pop($pilha);
echo"Ultimo elemento tirado da pilha:{$elemento}";