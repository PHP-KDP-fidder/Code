<?php

declare(strict_types=1);

namespace PhpFidder\Core\Components\Landing\Response;

use Laminas\Diactoros\Response;
use PhpFidder\Core\Renderer\RenderAwareInterface;

class IndexResponse extends Response implements RenderAwareInterface
{
    public function __construct(public readonly array $indexdata)
    {
        parent::__construct();
    }

    public function getTemplateName()
    {
        return 'index';
    }
}
