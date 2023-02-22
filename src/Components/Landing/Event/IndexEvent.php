<?php
declare(strict_types=1);

namespace PhpFidder\Core\Components\Landing\Event;

final class IndexEvent
{

    public function __construct(private string $message)
    {
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getWelcomeMessage(): string
    {
        return $this->message;
    }
}
