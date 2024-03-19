<?php

declare(strict_types=1);

namespace FiftyDeg\SyliusScriptsPlugin\DependencyInjection;

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
}
