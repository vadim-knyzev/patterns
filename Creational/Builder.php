<?php
 
/**
 * Паттерн строитель, оперирует известными "рецептами строительства"
 */
 
/**
 * Pizza - Базовый объект строительства
 */
class Pizza {
 
    private $_pastry = "";
    private $_sauce = "";
    private $_garniture = "";
 
    public function setPastry($pastry) {
        $this->_pastry = $pastry;
    }
    public function setSauce($sauce) {
        $this->_sauce = $sauce;
    }
    public function setGarniture($garniture) {
        $this->_garniture = $garniture;
    }
 
}
 
/**
 * Builder - Абстрактный строитель
 */
abstract class BuilderPizza {
 
    protected $_pizza;
 
    public function getPizza() {
        return $this->_pizza;
    }
    public function createNewPizza() {
        $this->_pizza = new Pizza ();
    }
 
    abstract public function buildPastry();
    abstract public function buildSauce();
    abstract public function buildGarniture();
 
}
 
/**
 * BuilderConcret - Конкретный строитель 1
 */
class BuilderPizzaHawaii extends BuilderPizza {
 
    public function buildPastry() {
        $this->_pizza->setPastry ( "normal" );
    }
    public function buildSauce() {
        $this->_pizza->setSauce ( "soft" );
    }
    public function buildGarniture() {
        $this->_pizza->setGarniture ( "jambon+ananas" );
    }
 
}
 
/**
 * BuilderConcret - Конкретный строитель 2
 */
class BuilderPizzaSpicy extends BuilderPizza {
 
    public function buildPastry() {
        $this->_pizza->setPastry ( "puff" );
    }
    public function buildSauce() {
        $this->_pizza->setSauce ( "hot" );
    }
    public function buildGarniture() {
        $this->_pizza->setGarniture ( "pepperoni+salami" );
    }
 
}
 
/**
 * Waiter - Разносчик
 */
class Waiter {
    private $_builderPizza;
 
    public function setBuilderPizza(BuilderPizza $mp)
    {
        $this->_builderPizza = $mp;
    }
    public function getPizza()
    {
        return $this->_builderPizza->getPizza();
    }
    public function constructPizza() {
        $this->_builderPizza->createNewPizza ();
        $this->_builderPizza->buildPastry ();
        $this->_builderPizza->buildSauce ();
        $this->_builderPizza->buildGarniture ();
    }
}
 
// Инициализация разносчика
$waiter = new Waiter();
 
// Инициализация доступных продуктов
$builderPizzaHawaii  = new BuilderPizzaHawaii();
$builderPizzaPiquante = new BuilderPizzaSpicy();
 
// Подготовка и получение продукта
$waiter->setBuilderPizza( $builderPizzaHawaii );
$waiter->constructPizza();
$pizza = $waiter->getPizza();