<?php

declare(strict_types=1);

namespace FiftyDeg\SyliusScriptsPlugin\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    /**
     * @psalm-suppress UnusedVariable
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('fifty_deg_sylius_scripts_plugin');
        $rootNode = $treeBuilder->getRootNode();

        return $treeBuilder;
    }
}
