<?php 
//combinação de arrays

$dados1 =[
    "nome"=>"David",
    "idade"=>36,
    "cidade"=>"Curitiba",
    "Estado"=>"Paraná"
];

$dados2 =[
    "País"=>"Brasil",
    "idioma"=>"Portugues",
    "sexo"=>"masculino"
];

$dadosCombinados=array_merge($dados1,$dados2);

print_r($dadosCombinados);