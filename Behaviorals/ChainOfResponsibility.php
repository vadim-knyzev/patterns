<?php

/**
 * Цепочка обязанностей предназначен для организации уровней отвественности
 */
namespace ChainOfResponsibility {

    /**
     * Абстрактный класс с поддержкой цепочки отвественности
     */
    abstract class Logger {

        const ERR = 3;
        const NOTICE = 5;
        const DEBUG = 7;

        protected $mask;
        // The next element in the chain of responsibility
        protected $next;

        /**
         * Construct
         * @param integer $mask уровень ответственности
         */
        public function __construct($mask) {
            $this->mask = $mask;
        }

        /**
         * Добавление объекта в цепочку
         * @param \ChainOfResponsibility\Logger $log
         * @return \ChainOfResponsibility\Logger
         */
        public function setNext(Logger $log) {
            $this->next = $log;
            return $log;
        }

        /**
         * Получение сообщения
         * Если переданная маска полномочий соотвествует уровню этого объекта
         * будет выполнен код, если не соотвествует то действие будет передано по цепочке объектов
         * @param string $msg
         * @param integer $priority приоритет
         */
        public function message($msg, $priority) {
            if ($priority <= $this->mask) {
                $this->writeMessage($msg);
            }

            if ($this->next) {
                $this->next->message($msg, $priority);
            }
        }

        protected abstract function writeMessage($msg);
    }

    class StdoutLogger extends Logger {

        protected function writeMessage($msg) {
            echo sprintf("Writing to stdout: %s\n", $msg);
        }

    }

    class EmailLogger extends Logger {

        protected function writeMessage($msg) {
            echo sprintf("Sending via email: %s\n", $msg);
        }

    }

    class StderrLogger extends Logger {

        protected function writeMessage($msg) {
            echo sprintf("Sending to stderr: %s\n", $msg);
        }

    }
    
    //цепочка обязанностей
    class ChainOfResponsibilityExample {
        public function run() {
            
            // строим цепочку обязанностей
            $logger = new StdoutLogger(Logger::DEBUG);
            $logger->setNext(new EmailLogger(Logger::NOTICE))
                    ->setNext(new StderrLogger(Logger::ERR));

            // Handled by StdoutLogger and StdoutLogger
            $logger->message("Entering function y.", Logger::DEBUG);

            // Handled by StdoutLogger and EmailLogger
            $logger->message("Step1 completed.", Logger::NOTICE);

            // Handled by all three loggers
            $logger->message("An error has occurred.", Logger::ERR);
        }
    }
    
    $chain = new ChainOfResponsibilityExample();
    $chain->run();

}



?>
