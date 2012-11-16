<?php

final class GameCode {

    const CHESS = 'chess';
    const MONOPOLY = 'monopoly';

}


/**
 *  Абстрактный класс, реализация абстрактных методов которого будет специфичной для каждого вида игры.
 **/
abstract class Game {

    private $playersAmount;

    protected abstract function initializeGame();

    protected abstract function playGame();

    protected abstract function endGame();

    protected abstract function printWinner();

    public function playOneGame($playersAmount) {
        $this->setPlayersAmount(playersAmount);

        $this->initializeGame();
        $this->playGame();
        $this->endGame();

        $this->printWinner();
    }

    public function setPlayersAmount($playersAmount) {
        $this->playersAmount = $playersAmount;
    }
}

/*      Игра "Шахматы". Специфически только для шахмат реализует методы класса Game.
 * */

class Chess extends Game {

    protected function initializeGame() {
        // chess specific initialization actions
    }

    protected function playGame() {
        // chess specific play actions
    }

    protected function endGame() {
        // chess specific actions to end a game
    }

    protected function printWinner() {
        // chess specific actions to print winner
    }

}

/*      Игра "Монополия". Специфически только для монополии реализует методы класса Game.
 * */

class Monopoly extends Game {

    protected function initializeGame() {
        // monopoly specific initialization actions
    }

    protected function playGame() {
        // monopoly specific play actions
    }

    protected function endGame() {
        // monopoly specific actions to end a game
    }

    protected function printWinner() {
        // monopoly specific actions to print winner
    }

}

/*      Класс, показывающий работу шаблона проектирования "Шаблонный метод".
 *
 * */

class GamesManager {

    public function run() {
        $gameCode = GameCode::CHESS;

        $game = '';

        switch ($gameCode) {
            case GameCode::CHESS :
                $game = new Chess();
                break;
            case GameCode::MONOPOLY :
                $game = new Monopoly();
                break;
            default:
                throw new \Exception();
        }

        $game->playOneGame(2);
    }

}

$gamesManager = new GamesManager();
$gamesManager->run();
?>
