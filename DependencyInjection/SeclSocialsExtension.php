<?php

namespace Secl\SocialsBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link
 * http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class SeclSocialsExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__ . '/../Resources/config')
        );
        $loader->load('services.yml');

        foreach ($config['buttons'] as $network => $value) {
            $container->setParameter('buttons.' . $network, $value);
        }
        foreach ($config['links'] as $network => $value) {
            $container->setParameter('links.' . $network, array(
                'network' => $network,
                'url' => $value,
                'theme' => $config['theme'],
            ));
        }
        $container->setParameter('social.theme', $config['theme']);

        //set configured networks to the social bar
        $container->getDefinition('twig.extension.secl_social_bar')
            ->addMethodCall(
                'setNetworks',
                array(array_keys($config['buttons']))
            );
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return 'secl_socials';
    }
}
