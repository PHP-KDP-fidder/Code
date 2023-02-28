<?php

declare(strict_types=1);

namespace PhpFidder\Core\Repository;

use PhpFidder\Core\Entity\UserEntity;

interface UserRepository
{
    public function add(UserEntity $userEntity): bool;
    public function persist(): bool;
    public function userExists(string $username): bool;
    public function emailExists(string $email): bool;
    public function findByUsername(string $username): UserEntity;
}
