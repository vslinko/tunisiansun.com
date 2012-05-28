<?php

namespace Rithis\StoreBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Reference;

class RithisStoreExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');

        $container
            ->getDefinition('rithis.store.listener.product_photo_uploader')
            ->addArgument(new Reference($config['filesystem_id']))
        ;

        $container
            ->getDefinition('rithis.store.twig.store_extension')
            ->addArgument($config['asset_url_pattern'])
        ;
    }
}
