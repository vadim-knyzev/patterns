<?php

/**
 * Интерфейс наблюдателья
 * метод update будет вызван у всех наблюдателей подписанных на изменение погоды
 */
interface Observer {
    public function update ($temperature, $humidity, $pressure);
}

/**
 * Интерфейс наблюдаемого объекта, предоставляющий возможности для наблюдения за ним
 */
interface Observable {
    public function registerObserver(Observer $o);
    public function removeObserver(Observer $o);
    public function notifyObservers();
}

/**
 * Интерфейс для класса отображающего данные системы
 */
interface DisplayElement {
    public function display();
}

/**
 * Класс хранящий информацию о состоянии погоды, 
 * предоставляет интерфейс для подписки на события обновления погоды
 */
class WeatherData implements Observable {
    private $observers = array();
    private $temperature;
    private $humidity;
    private $pressure;
 
    
    public function registerObserver(Observer $o) {
        $this->observers[] = $o;
    }
 
    public function removeObserver(Observer $o) {
        $keys = array_keys($this->observers, $o);
        if(count($keys) > 0){
            unset($this->observers[$keys[0]]);
        }
    }
 
    /**
     * Уведомить подписчиков об изменении состояния погоды
     */
    public function notifyObservers() {
        foreach($this->observers as  $observer){
            $observer->update($this->temperature, $this->humidity, $this->pressure);
        }
    }
 
    private function measurementsChanged() {
        $this->notifyObservers();
    }
 
    /**
     * Обновить данные о погоде
     * @param type $temperature
     * @param type $humidity
     * @param type $pressure
     */
    public function setMeasurements($temperature, $humidity, $pressure){
        $this->temperature = $temperature;
        $this->humidity = $humidity;
        $this->pressure = $pressure;
        $this->measurementsChanged();
    }
}

/**
 * Класс наблюдатель, отображающий текущие параметры погоды
 * Класс реализует интерфейс Observer
 */
class CurrentConditionsDisplay implements Observer, DisplayElement{
    private $temperature;
    private $humidity;
    private $weatherData;
 
    public function __construct(Observable $weatherData){
        $this->weatherData = $weatherData;
        $weatherData->registerObserver($this);
    }
    
    /**
     * Обновить параметры и напечатать значения на экран
     * @param type $temperature
     * @param type $humidity
     * @param type $pressure
     */
    public function update($temperature, $humidity, $pressure) {
        $this->temperature = $temperature;
        $this->humidity = $humidity;
        $this->display();
    }

    public function display() {
        echo sprintf("Сейчас значения: %.1f градусов цельсия и %.1f %% влажности\n", $this->temperature, $this->humidity);
    }
 
}


/**
 * Состояние погоды, базовый класс приложения
 */
class WeatherStationApplication {
 
    /**
     * Запуск приложения
     */
    public function run(){
        $weatherData = new WeatherData();
 
        //регистрируем наблюдателя за состоянием погоды
        $currentDisplay = new CurrentConditionsDisplay($weatherData);
        
        //устанвливаем значения погоды
        $weatherData->setMeasurements(29, 65, '30.4f');
        $weatherData->setMeasurements(39, 70, '29.4f');
        $weatherData->setMeasurements(42, 72, '31.4f');
    }
}

$weatherApplication = new WeatherStationApplication();
$weatherApplication->run();