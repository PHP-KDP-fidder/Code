<?php
declare(strict_types=1);

namespace PhpFidder\Core\Registration\Action;

use Laminas\Diactoros\Response;
use PhpFidder\Core\Registration\Hydrator\UserHydrator;
use PhpFidder\Core\Registration\Validator\RegisterValidator;
use PhpFidder\Core\Renderer\TemplateRendererInterface;
use PhpFidder\Core\Repository\UserRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class Register
{
    public function __construct(private readonly TemplateRendererInterface $templateRenderer,
                                private readonly RegisterValidator $registerValidator,
                                private readonly UserHydrator $userHydrator,
                                private readonly UserRepository $userRepository)
    {
    }

    public function __invoke(ServerRequestInterface $serverRequest): ResponseInterface {
        $body = [];
        $isPostRequest = $serverRequest->getMethod() === 'POST';
        if ($isPostRequest) {
            $body = $serverRequest->getParsedBody();
        }


        $username = $body['username'] ?? '';
        $email = $body['email'] ?? '';
        $passwort = $body['password'] ?? '';
        $passwortRepeat = $body['passwordRepeat'] ?? '';

        if ($isPostRequest && $this->registerValidator->isValid($username, $email, $passwort, $passwortRepeat)) {

            $user = $this->userHydrator->hydrate($body);
            $this->userRepository->add($user);
            $this->userRepository->persist();
            // User erstellen
            // Redirect
            return new Response\RedirectResponse('/');
        }

        $body = $this->templateRenderer->render('register', [
            'username' => $username,
            'email' => $email,
            'password' => $passwort,
            'passwordRepeat' => $passwortRepeat,
            'errors' => $this->registerValidator->getErrors(),
        ]);
        $response = new Response;
        $response->getBody()->write($body);
        return $response;
    }
}
