<?php

//целевой интерфейс
interface Chief {

    public function makeBreakfeast();

    public function makeLunch();

    public function makeDinner();
}

//адаптируемый объект
class Plumber {

    public function getScrewNut() {
        return '';
    }

    public function getPipe() {
        return '';
    }

    public function getGasket() {
        return '';
    }

}

class ChiefAdapter extends Plumber implements Chief {

    public function makeBreakfeast() {
        return $this->getGasket();
    }

    public function makeLunch() {
        return $this->getPipe();
    }

    public function makeDinner() {
        return $this->getScrewNut();
    }

}


//chiefAdapter имеет интерфейс Chief
?>
