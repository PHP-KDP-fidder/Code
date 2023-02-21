<?php
declare(strict_types=1);

namespace PhpFidder\Core\Components\Login\Response;

use Laminas\Diactoros\Response;
use PhpFidder\Core\Components\Login\LoginRequest\LoginRequest;
use PhpFidder\Core\Renderer\RenderAwareInterface;

class LoginResponse extends Response implements RenderAwareInterface
{
    public readonly string $username;
    public readonly string $eamil;
    public readonly string $password;
    public readonly array $errors;
    public function __construct(LoginRequest $loginRequest)
    {
        parent::__construct();
        $this->username = $loginRequest->getUsername();
        $this->eamil = $loginRequest->getEmail();
        $this->password = $loginRequest->getPassword();
        $this->errors = $loginRequest->getErrors();
    }

    public function getTemplateName()
    {
        return 'login';
    }
}
