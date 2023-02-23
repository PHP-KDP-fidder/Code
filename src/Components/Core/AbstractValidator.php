<?php
declare(strict_types=1);

namespace PhpFidder\Core\Components\Core;

abstract class AbstractValidator
{
    private array $errors = [];

    abstract function validate(ValidatorRequestInterface $request):array;

    public function isValid(ValidatorRequestInterface $request): bool
    {
        /**
         * @Comment
         * array kann schon durch setter vorbelegt sein,
         * deshalb ein foreach über validate
         */
        foreach ($this->validate($request) as $error) {
            $this->errors[] = $error;
        }
        return count($this->errors) === 0;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     */
    public function setErrors(string $error): void
    {
        $this->errors[] = $error;
    }
}
