<?php

interface Product {

    public function GetName();
}

class ProductA implements Product {

    private $Name = 'ProductA';

    public function GetName() {
        return $this->Name;
    }

}

class ProductB implements Product {

    private $Name = 'ProductB';

    public function GetName() {
        return $this->Name;
    }

}

interface Creator {

    public function getProduct();
}

class CreatorA implements Creator {

    public function getProduct() {
        return new ProductA();
    }

}

class CreatorB implements Creator {

    public function getProduct() {
        return new ProductB();
    }

}

$creator1 = new CreatorA();
$creator2 = new CreatorB();
$count = intval($_POST['count']);

if ($count == 1) {
    $type = $creator1->getProduct();
} else {
    if ($count <= 0) {
        die("false");
    } else {
        $type = array();
        for ($i = 1; $i <= $count; $i++) {
            $type[] = $creator2->getProduct();
        }
    }
}
?>