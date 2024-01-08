<?php 
//inicio da sessão
session_start();

//variável de controle
define('CONTROL',true);

//definição de rotas
$route = $_GET['route']?? 'start';

$script = null;

switch ($route) {
    case 'start':
        $script = 'start.php';
        break;
    case 'game':
        $script = 'game.php';
        break;
    default:
        die('Acesso negado');
        
}

//view
require "inc/header.php";
require "inc/$script";
require "inc/footer.php";