<?php
//filas e pilhas na estrutura de dados
//Fila = primeiro que entra é o primeiro que sai
$fila = array();
array_push($fila, "Cliente 1");
array_push($fila, "Cliente 2");
array_push($fila, "Cliente 3");
array_push($fila, "Cliente 4");
array_push($fila, "Cliente 5");

$cliente = array_shift($fila);

echo "O primeiro cliente a entrar é o primeiro a sair da pilha é o:{$cliente}";
