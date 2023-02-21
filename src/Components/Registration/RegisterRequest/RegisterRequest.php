<?php

declare(strict_types=1);

namespace PhpFidder\Core\Components\Registration\RegisterRequest;

use PhpFidder\Core\Components\Core\ValidatorRequestInterface;
use Psr\Http\Message\ServerRequestInterface;

class RegisterRequest implements ValidatorRequestInterface
{
    private readonly string $username;
    private readonly string $email;
    private readonly string $password;
    private readonly string $passwordRepeat;
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
            $this->passwordRepeat = $body['passwordRepeat'] ?? '';
        }
    }
    //
    public function toArray(): array
    {
        return [
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password,
            'passwordRepeat' => $this->passwordRepeat,
        ];
    }
    //
    public function isPostRequest(): bool
    {
        return $this->method === 'POST';
    }
    //
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

    /**
     * @return string
     */
    public function getPasswordRepeat(): string
    {
        return $this->passwordRepeat;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
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
}
