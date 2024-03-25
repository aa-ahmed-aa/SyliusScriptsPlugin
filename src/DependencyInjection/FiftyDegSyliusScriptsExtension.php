<?php

declare(strict_types=1);

namespace FiftyDeg\SyliusScriptsPlugin\DependencyInjection;

use Error;
use Sylius\Bundle\CoreBundle\DependencyInjection\PrependDoctrineMigrationsTrait;
use Sylius\Bundle\ResourceBundle\DependencyInjection\Extension\AbstractResourceExtension;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

final class FiftyDegSyliusScriptsExtension extends AbstractResourceExtension implements PrependExtensionInterface
{
    use PrependDoctrineMigrationsTrait;

    public const CONTAINER_PARAM_PREFIX = '_fd_scripts.';

    /** @psalm-suppress UnusedVariable */
    public function load(array $config, ContainerBuilder $container): void
    {
        $processedConfigs = $this->processConfiguration($this->getConfiguration([], $container), $config);

        $fileLocator = new FileLocator(__DIR__ . '/../Resources/config');
        $loader = new YamlFileLoader($container, $fileLocator);
        $loader->load('bundle.yaml');

        foreach ($processedConfigs as $key => $param) {
            $container->setParameter(self::CONTAINER_PARAM_PREFIX . $key, $param);
        }
    }

    public function prepend(ContainerBuilder $container): void
    {
        $this->prependDoctrineMigrations($container);
        $this->prependSyliusUi($container);
    }

    protected function getMigrationsNamespace(): string
    {
        return 'DoctrineMigrations';
    }

    protected function getMigrationsDirectory(): string
    {
        return '@FiftyDegSyliusScriptsPlugin/Migrations';
    }

    protected function getNamespacesOfMigrationsExecutedBefore(): array
    {
        return [
            'Sylius\Bundle\CoreBundle\Migrations',
        ];
    }

    protected function prependSyliusUi($container)
    {
        try {
            $configs = $container->getExtensionConfig($this->getAlias());

            $scriptsTemplateEvents = $configs[0]['template_events'];

            $events = [];

            foreach($scriptsTemplateEvents as $scriptTemplateEvent) {
                $templateEventName = $scriptTemplateEvent['value'];
                $blockHash = md5(serialize($scriptTemplateEvent));

                $events[$templateEventName] = [
                    'blocks' => [
                        'fiftydeg_script_' . $blockHash => [
                            'template' => '@FiftyDegSyliusScriptsPlugin/Shop/Scripts/_renderScript.html.twig',
                            'priority' => PHP_INT_MAX,
                            'context' => [
                                'template_event' => $templateEventName
                            ]
                        ]
                    ]
                ];
            }

            $container->prependExtensionConfig('sylius_ui', [
                'events' => $events
            ]);
        } catch (Error $error) {
            // Nothing to do here
        }
    }
}
