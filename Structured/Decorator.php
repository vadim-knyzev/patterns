<?php

abstract class AbstractComponent {

    abstract public function operation();
}

class ConcreteComponent extends AbstractComponent {

    public function operation() {
        // ...
    }

}

abstract class AbstractDecorator extends AbstractComponent {

    private $_component;

    public function __construct(AbstractComponent $component) {
        $this->_component = $component;
    }

    public function operation() {
        $this->_component->operation();
    }

}

class ConcreteDecorator extends AbstractDecorator {

    public function operation() {
        parent::operation();
        
        //advanced functional
    }

}

$decoratedComponent = new ConcreteDecorator(
                new ConcreteComponent()
);

$decoratedComponent->operation();