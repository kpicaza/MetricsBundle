<?php

namespace Kpicaza\Bundle\MetricsBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class KpicazaMetricsExtension extends Extension
{

    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter($this->getAlias() . '.track_admins', $config['track_admins']);
        $container->setParameter($this->getAlias() . '.entities', $config['entities']);
        if (true === $config['enable_blocks']) {
            foreach ($config['entities'] as $key => $value) {
                foreach ($value as $paramKey => $paramValue) {
                    $container->setParameter($this->getAlias() . '.' . $key . '.' . $paramKey, $paramValue);
                }
            }
        }

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('listeners.yml');
        $loader->load('services.yml');
    }

    public function getAlias()
    {
        return 'kpicaza_metrics';
    }

}
