<?php
/**
 * Created by PhpStorm.
 * User: Nai
 * Date: 08.11.2019
 * Time: 23:07
 */

namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;
use MyProject\Models\Users\User;
use MyProject\Services\Db;
use MyProject\Services\UsersAuthService;
use MyProject\View\View;

class MainController
{
    /** @var View */
    private $view;

    /** @var User|null */
    private $user;

    public function __construct()
    {
        $this->user = UsersAuthService::getUserByToken();
        $this->view = new View(__DIR__ . '/../../../templates');
        $this->view->setVar('user', $this->user);
    }

    public function main()
    {
        $articles = Article::findAll();
        $this->view->renderHtml('main/main.php', [
            'articles' => $articles,
            'user' => UsersAuthService::getUserByToken()
        ]);
    }

    public function sayHello(string $name)
    {
        $title = 'Страница приветствия';
        $this->view->renderHtml('main/hello.php', ['name' => $name, 'title' => $title]);
    }
}