<?php

/**
 * Класс вызывающий команды
 */
class SwitchInvoker {

    private $flipUpCommand;
    private $flipDownCommand;

    public function __construct(Command $flipUpCmd, Command $flipDownCmd) {
        $this->flipUpCommand = $flipUpCmd;
        $this->flipDownCommand = $flipDownCmd;
    }

    public function flipUp() {
        $this->flipUpCommand->execute();
    }

    public function flipDown() {
        $this->flipDownCommand->execute();
    }

}

/**
 * Класс предоставляющий действия
 */
class Light {

    public function turnOn() {
        echo sprintf("The light is on\n");
    }

    public function turnOff() {
        echo sprintf("The light is off\n");
    }

}

/**
 * Интерфейс для класса Command
 */
interface Command {

    public function execute();
}


class TurnOnLightCommand implements Command {

    private $theLight;

    public function __construct(Light $light) {
        $this->theLight = $light;
    }

    public function execute() {
        $this->theLight->turnOn();
    }

}


class TurnOffLightCommand implements Command {

    private $theLight;

    public function __construct(Light $light) {
        $this->theLight = $light;
    }

    public function execute() {
        $this->theLight->turnOff();
    }

}

/**
 * Клиент запускающий действия
 */
class TestCommand {

    public function run() {
        $l = new Light();
        $switchUp = new TurnOnLightCommand($l);
        $switchDown = new TurnOffLightCommand($l);

        $invoker = new SwitchInvoker($switchUp, $switchDown);

        $invoker->flipUp();
        $invoker->flipDown();
    }

}

$test = new TestCommand();
$test->run();
?>