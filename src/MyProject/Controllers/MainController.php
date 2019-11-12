<?php
/**
 * Created by PhpStorm.
 * User: Nai
 * Date: 08.11.2019
 * Time: 23:07
 */

namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;
use MyProject\Services\Db;
use MyProject\View\View;

class MainController
{
    /** @var View */
    private $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
    }

    public function main()
    {
        $articles = Article::findAll();
        $this->view->renderHtml('main/main.php', ['articles' => $articles]);
    }

    public function sayHello(string $name)
    {
        $title = 'Страница приветствия';
        $this->view->renderHtml('main/hello.php', ['name' => $name, 'title' => $title]);
    }
}