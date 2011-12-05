<?php

namespace Knp\Bundle\InvoiceBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Definition\Processor;

class KnpInvoiceExtension extends Extension
{
    /**
     * @{inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config/'));
        $loader->load('invoice.xml');

        $configuration = new Configuration();
        $processor = new Processor();
        $config = $processor->processConfiguration($configuration, $configs);

        if (isset($config['generator']) && !in_array($config['generator'], array('twig', 'snappy'))) {
            throw new \InvalidArgumentException('Unknown generator used.');
        }

//        $container->setParameter('knp_invoice.default_generator', $config['generator']);
    }
}