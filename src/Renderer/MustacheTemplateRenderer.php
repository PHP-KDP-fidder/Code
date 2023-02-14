<?php
declare(strict_types=1);
namespace PhpFidder\Core\Renderer;

use Mustache_Engine;

class MustacheTemplateRenderer implements TemplateRendererInterface
{

    public function __construct(private readonly Mustache_Engine $mustache)
    {
    }

    public function render(string $templateName, $data): string
    {
        return $this->mustache->render($templateName, $data);
    }

}
