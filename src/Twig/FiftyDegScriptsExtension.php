<?php

declare(strict_types=1);

namespace FiftyDeg\SyliusScriptsPlugin\Twig;

use FiftyDeg\SyliusScriptsPlugin\Repository\ScriptRepositoryInterface;
use Sylius\Component\Channel\Context\ChannelContextInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class FiftyDegScriptsExtension extends AbstractExtension
{
    public function __construct(
        private ChannelContextInterface $channelContext,
        private ScriptRepositoryInterface $scriptRepository
    )
    {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('fiftydeg_scripts', [$this, 'renderScripts'])
        ];
    }

    public function renderScripts(string $templateEvent): ?string
    {
        $scripts = $this->scriptRepository->findBy(['templateEvent' => $templateEvent]);

        $rendered = "";

        foreach($scripts as $script) {
            if (!$this->isEnabled($script)) {
                continue;
            }

            $rendered .= $script->getContent();
        }

        return $rendered;
    }

    private function isEnabled($script): bool
    {
        return $script->getChannels()->exists(function ($key, $scriptChannel) {
            $scriptChannelCode = $scriptChannel->getCode();
            $currentChannelCode = $this->channelContext->getChannel()->getCode();

            return $scriptChannelCode === $currentChannelCode;
        });
    }
}
