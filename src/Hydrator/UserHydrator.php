<?php

declare(strict_types=1);

namespace PhpFidder\Core\Hydrator;

use PhpFidder\Core\Entity\UserEntity;
use Ramsey\Uuid\Uuid;

class UserHydrator
{
    public function hydrate(array $data): UserEntity
    {
        $id = $data['id'] ?? Uuid::uuid7()->getBytes();
//        $passwordHash = password_hash($data['password'], PASSWORD_BCRYPT);
        return new UserEntity($id, $data['username'], $data['email'], $data['passwordHash'], new \DateTime());
    }
}
