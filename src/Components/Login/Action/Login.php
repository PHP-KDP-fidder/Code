<?php
declare(strict_types=1);

namespace PhpFidder\Core\Components\Login\Action;

use Laminas\Diactoros\Response\RedirectResponse;
use Laminas\Session\Container;
use PhpFidder\Core\Components\Core\PasswordHasherInterface;
use PhpFidder\Core\Components\Login\Event\LoginSuccessEvent;
use PhpFidder\Core\Components\Login\LoginRequest\LoginRequest;
use PhpFidder\Core\Components\Login\Response\LoginResponse;
use PhpFidder\Core\Components\Login\Validator\LoginValidator;
use PhpFidder\Core\Repository\UserRepository;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class Login
{
    public function __construct(private readonly LoginValidator $loginValidator,
                                private readonly UserRepository $userRepository,
                                private readonly PasswordHasherInterface $passwordHasher,
                                private readonly Container $session,
                                private readonly EventDispatcherInterface $eventDispatcher
    )
    {
    }
    //
    public function __invoke(ServerRequestInterface $serverRequest): ResponseInterface {

        $loginRequest = new LoginRequest($serverRequest);
        $userExists = $this->userRepository->userExists($loginRequest->getUsername());
        if ($userExists === false) {
            $this->loginValidator->enableUserNotExistsError();
        }

        if ($loginRequest->isPostRequest() && $this->loginValidator->isValid($loginRequest)) {

            $user = $this->userRepository->findByUsername($loginRequest->getUsername());
            $passwordIsValid = $this->passwordHasher->isValid($loginRequest->getPassword(), $user->getPasswordHash());
            if ($passwordIsValid) {
                $this->session->userId = $user->getId();
                $event = new LoginSuccessEvent($user);
                $this->eventDispatcher->dispatch($event);
                return new RedirectResponse('/');
            } else {
                $this->loginValidator->setError('Passwort nicht korrekt');
            }

        }

        $loginRequest = $loginRequest->withErrors($this->loginValidator->getErrors());

        return new LoginResponse($loginRequest);

    }
}
