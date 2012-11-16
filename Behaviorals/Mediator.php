<?php

//абстрактный класс посредник
abstract class Mediator {
    /**
     * Отправка сообщения {@code message} указанному получателю {@code colleague}
     * @param string message отправляемое сообщение
     * @param Collegue colleague получатель сообщения
     */
    public abstract function send($message, Colleague $collegue);
}

//абстрактный класс коллега
abstract class Colleague {
    protected $mediator;
    
    public function __construct(Mediator $mediator) {
        $this->mediator = $mediator;
    }
    
    /**
     * Отправка сообщения посредством посредника
     * @param string message сообщение
     */
    public function send($message){
        $this->mediator->send($message, $this);
    }
    
    /**
     * Обработка полученного сообщения реализуется каждым конкретным
     * наследником
     * @param string message полчаемое сообщение
     */
    public abstract function notify($message);
}

class ConcreteMediator extends Mediator {
    private $colleague1;
    private $colleague2;
    
    public function setColleague1(ConcreteColleague1 $colleague){
        $this->colleague1 = $colleague;
    }
    
    public function setColleague2(ConcreteColleague2 $colleague){
        $this->colleague2 = $colleague;
    }
    
    public function send($message, Colleague $colleague) {
        if ($colleague == $this->colleague1) {
            $this->colleague2->notify($message);
        } else {
            $this->colleague1->notify($message);
        }
    }
}


//коллега 1
class ConcreteColleague1 extends Colleague {
    public function notify($message) {
        echo sprintf("Collegue1 gets message: %s\n", $message);
    }
}

//коллега 2
class ConcreteColleague2 extends Colleague {
    public function notify($message) {
        echo sprintf("Collegue2 gets message: %s\n", $message);
    }
}



$mediator = new ConcreteMediator();

$collegue1 = new ConcreteColleague1($mediator);
$collegue2 = new ConcreteColleague2($mediator);

$mediator->setColleague1($collegue1);
$mediator->setColleague2($collegue2);

$collegue1->send('How are you ?');
$collegue2->send('Fine, thanks!');
?>
