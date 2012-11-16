<?php

/*
 * Паттерн хранитель, используется для хранения и восстановления состояния объекта
 */
namespace Memento {

    /**
     * Класс поддерживаюший сохранение состояний внутреннего состояния
     */
    class Originator {

        private $state;

        public function setState($state) {
            $this->state = $state;
            echo sprintf("State setted %s\n", $this->state);
        }

        public function getState() {
            return $this->state;
        }

        /**
         * Создать снимок состояния объекта
         * @return Memento
         */
        public function CreateMemento() {
            return new Memento($this->state);
        }

        /**
         * Восстановить состояние
         * @param \Memento\Memento $memento
         */
        public function setMemento(Memento $memento) {
            echo sprintf("Restoring state...\n");
            $this->state = $memento->getState();
        }

    }

    /**
     * Хранитель состояния
     */
    class Memento {

        private $state;

        public function __construct($state) {
            $this->state = $state;
        }

        public function getState() {
            return $this->state;
        }

    }

    /**
     * Смотрящий за состоянием объекта
     */
    class Caretaker {

        private $memento;

        public function getMemento() {
            return $this->memento;
        }

        public function setMemento(Memento $memento) {
            $this->memento = $memento;
        }

    }

    
    $originator = new Originator();
    $originator->setState("On");

    // Store internal state
    $caretaker = new Caretaker();
    $caretaker->setMemento($originator->CreateMemento());

    // Continue changing originator
    $originator->setState("Off");

    // Restore saved state
    $originator->setMemento($caretaker->getMemento());
}
 