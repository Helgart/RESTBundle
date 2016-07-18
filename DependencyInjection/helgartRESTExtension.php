<?php

namespace helgart\RESTBundle\DependencyInjection;

use helgart\RESTBundle\Exception\MissingBundleConfigurationException;
use helgart\RESTBundle\Exception\MissingBundleException;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;


class helgartRESTExtension extends Extension implements PrependExtensionInterface
{
    protected $mandatoryBundles = [
        'FOSRestBundle',
        'NelmioCorsBundle'
    ];

    protected $optionalBundles = [
        'NelmioApiDocBundle'
    ];

    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
    }

    public function prepend(ContainerBuilder $container)
    {
        $bundles = $container->getParameter('kernel.bundles');

        foreach ($this->mandatoryBundles as $mandatoryBundle) {
            if (!array_key_exists($mandatoryBundle, $bundles)) {
                throw new MissingBundleException("Bundle $mandatoryBundle is missing");
            }

            if (!file_exists(__DIR__ . '/../Resources/config/' . $mandatoryBundle . 'Config.yml')) {
                throw new MissingBundleConfigurationException('Configuration file ' . __DIR__ . '/../Resources/config/' . $mandatoryBundle . 'Config.yml is missing');
            }

            $bundleConfig = Yaml::parse(file_get_contents(__DIR__ . '/../Resources/config/' . $mandatoryBundle . 'Config.yml'));

            $this->prependBundleConfig($container, $bundleConfig);
        }

        foreach ($this->optionalBundles as $optionalBundle) {
            if (file_exists(__DIR__ . '/../Resources/config/' . $optionalBundle . 'Config.yml')) {
                $bundleConfig = Yaml::parse(file_get_contents(__DIR__ . '/../Resources/config/' . $optionalBundle . 'Config.yml'));

                $this->prependBundleConfig($container, $bundleConfig);
            }
        }
    }

    protected function prependBundleConfig(ContainerBuilder $container, array $bundleConfig)
    {
        foreach ($bundleConfig as $extension => $config) {
            $container->prependExtensionConfig($extension, $config);
        }
    }
}
