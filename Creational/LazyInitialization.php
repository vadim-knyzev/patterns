<?php

class LazyURL {

    protected
            $_stringUrl,
            $_proto,
            $_domain,
            $_path;

    /**
     * Создание экземпляра класса и передача ему строки URL
     */
    function __construct($stringUrl) {
        $this->_stringUrl = $stringUrl;
    }

    /**
     * Получаем имя протокола при первом обращении и сохраняем его значение
     */
    public function getProtocol() {
        if (empty($this->_proto)) {
            $this->_proto = parse_url($this->_stringUrl, 0);
        }

        return $this->_proto;
    }

    /**
     * Получаем доменное имя при первом обращении и сохраняем его значение
     */
    public function getDomain() {
        if (empty($this->_domain)) {
            $this->_domain = parse_url($this->_stringUrl, 1);
        }

        return $this->_domain;
    }

    /**
     * Получаем путь при первом обращении и сохраняем его значение
     */
    public function getPath() {
        if (empty($this->_path)) {
            $this->_path = parse_url($this->_stringUrl, 5);
        }

        return $this->_path;
    }

}

$url = new LazyURL('http://google.com/developers');
echo $url->getProtocol(); // значение вычислено и сохранено
echo "<br>\n";
echo $url->getDomain(); // значение вычислено и сохранено
echo "<br>\n";
echo $url->getPath(); // значение вычислено и сохранено
echo "<br>\n";
echo "<br>\n";
echo $url->getProtocol(); // получаем уже вычисленное значение
echo "<br>\n";
echo $url->getDomain(); // получаем уже вычисленное значение
echo "<br>\n";
echo $url->getPath(); // получаем уже вычисленное значение
?>
