<?php
/**
 * This file is part of a Lyssal project.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\SearchEngineBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * @inheritDoc
 */
class LyssalSearchEngineExtension extends Extension
{
    /**
     * @inheritDoc
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('lyssal_search_engine.search_engine.default', $config['search_engine']['default']);
        $container->setParameter('lyssal_search_engine.host.search_on_host', $config['host']['search_on_host']);
        $container->setParameter('lyssal_search_engine.host.default', $config['host']['default']);
        $container->setParameter('lyssal_search_engine.templating.form_template', $config['templating']['form_template']);
        $container->setParameter('lyssal_search_engine.templating.submit_value', $config['templating']['submit_value']);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yaml');
    }
}
