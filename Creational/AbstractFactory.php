<?php

interface GUIFactory {

    public function createButton();
}

class WinFactory implements GUIFactory {

    public function createButton() {
        return(new WinButton());
    }

}

class LinFactory implements GUIFactory {

    public function createButton() {
        return(new LinButton());
    }

}

abstract class Button {

    private $_caption;

    public abstract function render();

    public function getCaption() {
        return $this->_caption;
    }

    public function setCaption(GUIFactory $caption) {
        $this->_caption = $caption;
    }

}

class WinButton extends Button {

    public function render() {
        echo "I am WinButton: " . $this->getCaption();
    }

}

class LinButton extends Button {

    public function render() {
        echo "I am LinButton: " . $this->getCaption();
    }

}

####
/**
 * Класс инкапсулирует логику конструирования алгоритма создания каких-либо структур
 * например (GUI, алгоритмов доступа к БД, и т.д.). Класс ничего "не знает" о платформе, на которой он работает.
 */

class Application {

    public function __construct(GUIFactory $factory) {
        $button = $factory->createButton();
        $button->setCaption("Start");
        $button->render();
    }

}

/**
 * Класс определяет платформу на которой работает и в соответствии от неё создаёт "класс-клиент", использующий "продукты"
 * (в данном случае создание кнопок), с передаваемым параметром, определённой фабрики, в использование "клиентом".   
 */
class ApplicationRunner {

    public static function run() {
        new Application(self::createOsSpecificFactory());
    }

    public static function createOsSpecificFactory() {
        $sys = substr(PHP_OS, 0, 3);
        if (strtoupper($sys) === 'WIN') {
            return new WinFactory();
        } else {
            return new LinFactory();
        }
    }

}

ApplicationRunner::run();