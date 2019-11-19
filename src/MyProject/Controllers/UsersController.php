<?php
/**
 * Created by PhpStorm.
 * User: Nai
 * Date: 18.11.2019
 * Time: 18:18
 */

namespace MyProject\Controllers;

use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Models\Users\User;
use MyProject\View\View;

class UsersController
{
    /** @var View */
    private $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
    }

    public function signUp()
    {
        if (!empty($_POST)) {
            try {
                $user = User::signUp($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('users/signUp.php', ['error' => $e->getMessage()]);
                return;
            }
        }

        if ($user instanceof User) {
            $this->view->renderHtml('users/signUpSuccessful.php');
            return;
        }

        $this->view->renderHtml('users/signUp.php');
    }
}