<?php

// класс для хранения данных о сотруднике
class TEmployee {
 
        private $_name;
        private $_departament;
 
        public function __construct($name, $departament) {
                $this->_name = $name;
                $this->_departament = $departament;
        }
 
        public function getName() {
                return $this->_name;
        }
 
        public function getDepartament() {
                return $this->_departament;
        }
}
 
// имитация стандартного класса Delphi для хранения списка объектов
class TObjectList {
 
        private $_objList;
 
        public function __construct() {
                $this->free();
        }
        
        
        public function free() {
                $this->_objList = array();
        }
 
        public function count() {
                return count($this->_objList);
        }
 
        public function add($obj) {
                array_push($this->_objList, $obj);
        }
 
        public function remove($obj) {
                $k = array_search( $obj, $this->_objList, true );
                if ( $k !== false ) {
                        unset( $this->_objList[$k] );
                }
        }
 
        public function get($index) {
                return $this->_objList[$index];
        }
 
        public function set($index, $obj) {
                $this->_objList[$index] = $obj;
        }
}
 
// класс для хранения сотрудников
class TEmployeeList {
 
        // объект класса "список объектов"
        private $_employeersList;
 
        public function __construct(){
                // создаём объект методы которого будем делегировать
                $this->_employeersList = new TObjectList;
        }
 
        public function getEmployer($index) {
                return $this->_employeersList->get($index);
        }
 
        public function setEmployer($index, TEmployee $objEmployer) {
                $this->_employeersList->set($index, $objEmployer);
        }
 
        public function __destruct() {
                $this->_employeersList->free();
        }
 
        public function add(TEmployee $objEmployer) {
                $this->_employeersList->add($objEmployer);
        }
 
        public function remove(TEmployee $objEmployer) {
                $this->_employeersList->remove($objEmployer);
        }
 
        public function getIndexByName($name, $offset=0) {
                $result = -1; // предполагаем, что его нету в списке
                $cnt = $this->_employeersList->count();
                for ($i = $offset; $i < $cnt; $i++) {
                        if ( !strcmp( $name, $this->_employeersList->get($i)->getName() ) ) {
                                $result = $i;
                                break;
                        }
                }
                return $result;
        }
}
 
$obj1 = new TEmployee("User1", "department");
$obj2 = new TEmployee("User2", "department");
$obj3 = new TEmployee("User3", "department");
 
$objList = new TEmployeeList();
$objList->add($obj1);
$objList->add($obj2);
$objList->add($obj3);
?>
