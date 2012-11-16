<?php

abstract class Articles {

    protected $_articleView;

    abstract function printAll();

    function __construct(ArticleView $articleView) {
        $this->_articleView = $articleView;
    }

    protected function printLogic(array $articles) {
        $this->_articleView->printLogic($articles);
    }

}

class GameArticles extends Articles {

    function printAll() {
        $articles = array
            (
            'Статья об игре 1',
            'Статья об игре 2',
            'Статья об игре 3',
        );
        $this->printLogic($articles);
    }

}

class VideoArticles extends Articles {

    function printAll() {
        $articles = array
            (
            'Статья о фильме 1',
            'Статья о фильме 2',
            'Статья о фильме 3',
        );
        $this->printLogic($articles);
    }

}

interface ArticleView {

    function printLogic(array $articles);
}

class BlockArticleView implements ArticleView {

    function printLogic(array $articles) {
        echo 'Вывод блоками: | ' .
        implode(' | ', $articles)
        . ' |';
    }

}

class ListArticleView implements ArticleView {

    function printLogic(array $articles) {
        echo 'Вывод списком <br><ul><li>' .
        implode('</li><li>', $articles)
        . '</li></ul>';
    }

}

$listGameArticles = new GameArticles(new ListArticleView());
$listGameArticles->printAll();

$blockVideoArticles =
        new VideoArticles(new BlockArticleView());
$blockVideoArticles->printAll();
?>