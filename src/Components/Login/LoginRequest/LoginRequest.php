<?php

declare(strict_types=1);

namespace PhpFidder\Core\Components\Login\LoginRequest;

use PhpFidder\Core\Components\Core\ValidatorRequestInterface;
use Psr\Http\Message\ServerRequestInterface;

class LoginRequest implements ValidatorRequestInterface
{
    private readonly string $username;
    private readonly string $email;
    private readonly string $password;
    private readonly array $errors;

    private readonly string $method;

    public function __construct(ServerRequestInterface $request)
    {
        $body = $request->getParsedBody();
        $this->method = $request->getMethod();
        if ($body !== null) {
            $this->username = $body['username'] ?? '';
            $this->email = $body['email'] ?? '';
            $this->password = $body['password'] ?? '';
        }
    }
    //
    public function isPostRequest(): bool
    {
        return $this->method === 'POST';
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function withErrors(array $errors): self
    {
        $clone = clone $this;
        $clone->errors = $errors;
        return $clone;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }
}
