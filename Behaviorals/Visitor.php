<?php

/**
 * Интерфейс объекта над которым может выполняеться действие
 */
interface Obj {

    /**
     * @param Visitor $visitor
     * @param mixed $params
     */
    public function visit(Visitor $visitor, $params);
}

/**
 * Интерфейс посетителя
 */
interface Visitor {
    
    /**
     * Действие A
     * @param A $a
     * @param type $params
     */
    public function visitA(A $a, $params);
    
    /**
     * Действие B
     * @param B $b
     * @param type $params
     */
    public function visitB(B $b, $params);
}

/**
 * Класс А реализующий интерфейс Obj
 */
class A implements Obj {

    /**
     * Интерфейс для посетилеля
     * @param Visitor $visitor посетитель
     * @param mixed $params параметры
     */
    public function visit(Visitor $visitor, $params) {
        $visitor->visitA($this, $params);
    }
}

/**
 * Класс B реализующий интерфейс Obj
 */
class B implements Obj {

    /**
     * Интерфейс для посетителя
     * @param Visitor $visitor
     * @param type $params
     */
    public function visit(Visitor $visitor, $params) {
        $visitor->visitB($this, $params);
    }

}

/**
 * Посетитель
 */
class Visitor1 implements Visitor {

    /**
     * Действие которое выполняет посетитель
     */
    public function visitA(A $a, $params){
        echo sprintf("Execute method visitA in class Visitor1, params %s\n", $params);
    }
    
    /**
     * Действие которое выполняет посетитель
     */
    public function visitB(B $b, $params){
        
        echo sprintf("Execute method visitB in class Visitor1, params %s\n", $params);
    }
}

/**
 * Посетитель 2
 */
class Visitor2 implements Visitor {

    /**
     * Действие которое выполняет посетитель
     */
    public function visitA(A $a, $params){
        
        echo sprintf("Execute method visitA in class Visitor2, params %s\n", $params);
    }
    
    /**
     * Действие которое выполняет посетитель
     */
    public function visitB(B $b, $params){
        
        echo sprintf("Execute method visitB in class Visitor1, params %s\n", $params);
    }
}

class VisitorApplication {
    public function run(){
        $a = new A();
        $b = new B();
        
        $a->visit(new Visitor1(), 'visitor 1 visited class A');
        $b->visit(new Visitor1(), 'visitor 1 visited class B');
        
        $a->visit(new Visitor2(), 'visitor 2 visited class A');
        $b->visit(new Visitor2(), 'visitor 2 visited class B');
    }
}

$app = new VisitorApplication();
$app->run();

?>
