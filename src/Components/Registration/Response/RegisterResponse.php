<?php

declare(strict_types=1);

namespace PhpFidder\Core\Components\Registration\Response;

use Laminas\Diactoros\Response;
use PhpFidder\Core\Components\Registration\RegisterRequest\RegisterRequest;
use PhpFidder\Core\Renderer\RenderAwareInterface;

class RegisterResponse extends Response implements RenderAwareInterface
{
    public readonly string $username;
    public readonly string $eamil;
    public readonly string $password;
    public readonly string $passwordRepeat;
    public readonly array $errors;

    public function __construct(RegisterRequest $registerRequest)
    {
        parent::__construct();
        $this->username = $registerRequest->getUsername();
        $this->eamil = $registerRequest->getEmail();
        $this->password = $registerRequest->getPassword();
        $this->passwordRepeat =$registerRequest->getPasswordRepeat();
        $this->errors = $registerRequest->getErrors();
    }


    public function getTemplateName()
    {
        return 'register';
    }
}
