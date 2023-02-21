<?php

declare(strict_types=1);

namespace PhpFidder\Core\Components\Registration\Action;

use Laminas\Diactoros\Response;
use PhpFidder\Core\Components\Core\PasswordHasherInterface;
use PhpFidder\Core\Components\Registration\Event\RegistrationSuccessEvent;
use PhpFidder\Core\Components\Registration\RegisterRequest\RegisterRequest;
use PhpFidder\Core\Components\Registration\Response\RegisterResponse;
use PhpFidder\Core\Components\Registration\Validator\RegisterValidator;
use PhpFidder\Core\Hydrator\UserHydrator;
use PhpFidder\Core\Repository\UserRepository;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class Register
{
    public function __construct(
        private readonly RegisterValidator $registerValidator,
        private readonly UserHydrator $userHydrator,
        private readonly UserRepository $userRepository,
        private readonly PasswordHasherInterface $passwordHasher,
        private readonly EventDispatcherInterface $eventDispatcher
    )
    {
    }

    public function __invoke(ServerRequestInterface $serverRequest): ResponseInterface
    {
        $registerRequest = new RegisterRequest($serverRequest);

        $userExists = $this->userRepository->userExists($registerRequest->getUsername());
        if ($userExists) {
            $this->registerValidator->enableUsernameExists();
        }
        $emailExists = $this->userRepository->emailExists($registerRequest->getEmail());
        if ($emailExists) {
            $this->registerValidator->enableEmailExists();
        }

        if ($registerRequest->isPostRequest() &&
            $this->registerValidator->isValid($registerRequest)) {
            $user = $this->userHydrator->hydrate($registerRequest->toArray());
            $this->userRepository->add($user);
            $this->userRepository->persist();

            // TODO: event zum E-Mail versenden auslösen
            $event = new RegistrationSuccessEvent($user);
            $this->eventDispatcher->dispatch($event);

            return new Response\RedirectResponse('/');
        }

        $registerRequest = $registerRequest->withErrors($this->registerValidator->getErrors());

        return new RegisterResponse($registerRequest);
    }
}
