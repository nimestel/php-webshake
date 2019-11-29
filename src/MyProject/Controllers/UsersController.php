<?php
/**
 * Created by PhpStorm.
 * User: Nai
 * Date: 18.11.2019
 * Time: 18:18
 */

namespace MyProject\Controllers;

use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Exceptions\NotFoundException;
use MyProject\Models\Users\User;
use MyProject\Models\Users\UserActivationService;
use MyProject\Services\EmailSender;
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

            if ($user instanceof User) {
                $code = UserActivationService::createActivationCode($user);

                EmailSender::send($user, 'Активация', 'userActivation.php', [
                    'userId' => $user->getId(),
                    'code' => $code
                ]);

                $this->view->renderHtml('users/signUpSuccessful.php');
                return;
            }
        }

        $this->view->renderHtml('users/signUp.php');
    }

    /**
     * @param int $userId
     * @param string $activationCode
     * @throws NotFoundException
     */
    public function activate(int $userId, string $activationCode)
    {
        try {
            $user = User::getById($userId);
            if (!$user) {
                throw new NotFoundException('Нет такого пользователя');
            }

            $isCodeValid = UserActivationService::checkActivationCode($user, $activationCode);
            if ($isCodeValid) {
                $user->activate();
                UserActivationService::deleteActivationCode($user, $activationCode);
                $this->view->renderHtml('users/activateSuccessful.php');
            }
        } catch (NotFoundException $e) {
            $this->view->renderHtml('users/activateNotSuccessful.php', ['error' => $e->getMessage()]);
            throw new NotFoundException();
        }
    }
}