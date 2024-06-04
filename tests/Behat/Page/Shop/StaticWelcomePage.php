<?php

declare(strict_types=1);

namespace Tests\FiftyDeg\SyliusScriptsPlugin\Behat\Page\Shop;

use FriendsOfBehat\PageObjectExtension\Page\SymfonyPage;

class StaticWelcomePage extends SymfonyPage implements WelcomePageInterface
{
    /**
     * @inheritdoc
     */
    public function getGreeting(): string
    {
        return $this->getElement('greeting')->getText();
    }

    /**
     * @inheritdoc
     */
    public function getRouteName(): string
    {
        return 'fiftydeg_sylius_scripts_plugin_static_welcome';
    }

    /**
     * @inheritdoc
     */
    protected function getDefinedElements(): array
    {
        return array_merge(parent::getDefinedElements(), [
            'greeting' => '#greeting',
        ]);
    }
}
