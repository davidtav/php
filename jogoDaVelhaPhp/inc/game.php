<?php
defined('CONTROL') or die('Acesso Negado');

//ir para o proximo jogo
if (isset($_GET['next'])) {
    //adcionando um novo jogo
    $_SESSION['game_number']++;

    //resetar o tabuleiro
    $_SESSION['tabuleiro'] = [
        ['', '', ''],
        ['', '', ''],
        ['', '', '']
    ];
    // resetar a jogada    
    $_SESSION['game_turn'] = 1;

    //alternar o jogador ativo
    $_SESSION['active_player'] = $_SESSION['active_player'] == 1 ? 2 : 1;

    //ir para o proximo jogo
    header('Location:index.php?route=game');
}

if (isset($_GET['player'])  && isset($_GET['x']) && isset($_GET['y'])) {
    $player  = $_GET['player'];
    $x  = $_GET['x'];
    $y  = $_GET['y'];
    $ganhador = null;

    //verificação se existe algum simbolo a ser inserido no tabuleiro
    if (empty($_SESSION['tabuleiro'][$x][$y])) {
        //definir os simbolos aos jogadores
        $_SESSION['tabuleiro'][$x][$y] = $player == 1 ? 'X' : 'O';

        //verificação de qual jogador ganhou
        $status = check_game_status($player);

        if (!empty($status)) {
            //quem ganhou ?
            $ganhador = $player == 1 ? $_SESSION['player_1_name'] : $_SESSION['player_2_name'];

            $_SESSION[$player == 1 ? 'player_1_score' : 'player_2_score']++;
        }
        //verificação de empate
        if ($_SESSION['game_turn'] == 9 && empty($ganhador)) {
            $ganhador = 'Empate';
        }
        // se o jogo ainda não teve ganhador
        if (empty($ganhador)) {
            //mudar o jogador do primeiro para o segundo
            $_SESSION['active_player'] = $player == 1 ? 2 : 1;

            // incremento de mais uma jogada até a 9ª ou até que alguém ganhe
            $_SESSION['game_turn']++;
        }
    }
}
function check_game_status($player)
{
    /* 
    regras do jogo

           1       2       3       4       5       6       7       8
         0 1 2
     0 | x x x | - - - | - - - | x - - | - x - | - - x | x - - | - - x |  
     1 | - - - | x x x | - - - | x - - | - x - | - - x | - x - | - x - |
     2 | - - - | - - - | x x x | x - - | - x - | - - x | - - x | x - - |
    */

    $mark = $player == 1 ? 'X' : 'O';
    $tabuleiro = $_SESSION['tabuleiro'];
    $status = null;

    //situação 1 
    if ($tabuleiro[0][0] == $mark && $tabuleiro[0][1] == $mark && $tabuleiro[0][2] == $mark) {
        $status = 'win1';
    }
    //situação 2
    if ($tabuleiro[1][0] == $mark && $tabuleiro[1][1] == $mark && $tabuleiro[1][2] == $mark) {
        $status = 'win2';
    }
    //situação 3
    if ($tabuleiro[2][0] == $mark && $tabuleiro[2][1] == $mark && $tabuleiro[2][2] == $mark) {
        $status = 'win3';
    }
    //situação 4
    if ($tabuleiro[0][0] == $mark && $tabuleiro[1][0] == $mark && $tabuleiro[2][0] == $mark) {
        $status = 'win4';
    }
    //situação 5
    if ($tabuleiro[0][1] == $mark && $tabuleiro[1][1] == $mark && $tabuleiro[2][1] == $mark) {
        $status = 'win5';
    }
    //situação 6
    if ($tabuleiro[0][2] == $mark && $tabuleiro[1][2] == $mark && $tabuleiro[2][2] == $mark) {
        $status = 'win6';
    }
    //situação 7
    if ($tabuleiro[0][0] == $mark && $tabuleiro[1][1] == $mark && $tabuleiro[2][2] == $mark) {
        $status = 'win7';
    }
    //situação 8
    if ($tabuleiro[2][0] == $mark && $tabuleiro[1][1] == $mark && $tabuleiro[0][2] == $mark) {
        $status = 'win8';
    }

    return $status;
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col">
            <h3 class="text-center">
                Jogo da Velha
            </h3>
            <hr>
            <div class="row">
                <div class="col">
                    <h3 class="text-center <?= $_SESSION['active_player'] == 1 ? 'text-warning' : '' ?>"><?= $_SESSION['player_1_name'] ?></h3>
                    <h3 class="text-center"><?= $_SESSION['player_1_score'] ?></h3>
                </div>
                <div class="col">
                    <h3 class="text-center">
                        <span class="text-info">Jogo nº <?= $_SESSION['game_number'] ?></span>
                    </h3>
                </div>
                <div class="col text-end">
                    <h3 class="text-center <?= $_SESSION['active_player'] == 2 ? 'text-warning' : '' ?> "><?= $_SESSION['player_2_name'] ?></h3>
                    <h3 class="text-center"><?= $_SESSION['player_2_score'] ?></h3>
                </div>
            </div>
            <hr>
            <!-- Criando o tabuleiro -->
            <?php for ($linha = 0; $linha <= 2; $linha++) : ?>
                <div class="d-flex justify-content-center">
                    <?php for ($coluna = 0; $coluna <= 2; $coluna++) : ?>

                        <a href="index.php?route=game&player=<?= $_SESSION['active_player'] ?>&x=<?= $linha ?>&y=<?= $coluna ?>">
                            <div class="board-cell text-center">
                                <?php if ($_SESSION['tabuleiro'][$linha][$coluna] == 'X') : ?>
                                    <img src="assets/images/cross.png">
                                <?php elseif ($_SESSION['tabuleiro'][$linha][$coluna] == 'O') : ?>
                                    <img src="assets/images/circle.png">
                                <?php endif; ?>
                            </div>
                        </a>

                    <?php endfor; ?>
                </div>

            <?php endfor; ?>
            <?php if (!empty($ganhador)) : ?>
                <div class="text-center mt-5">
                    <h3 class="text-center text-warning"><?= $ganhador ?></h3>
                    <div class="text-center mt-5">
                        <a href="index.php?route=game&next=1" class=" btn btn-success w-25">PRÓXIMO JOGO</a>
                    </div>
                </div>
            <?php endif ?>
            <div class="text-center mt-5">
                <a href="index.php?route=start" class="btn btn-dark w-25">Reiniciar</a>
            </div>
        </div>
    </div>
</div>