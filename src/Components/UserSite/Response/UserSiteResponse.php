<?php

declare(strict_types=1);

namespace PhpFidder\Core\Components\UserSite\Response;

use Laminas\Diactoros\Response;
use PhpFidder\Core\Renderer\RenderAwareInterface;

class UserSiteResponse extends Response implements RenderAwareInterface
{
    public function __construct(public readonly array $userdata)
    {
    }


    public function getTemplateName()
    {
        return 'usersite';
    }
}
