<?php
namespace Bits\DevVitaBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class MakeComposerInfoFetcherPublicPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('Bits\DevVitaBundle\Service\ComposerInfoFetcher')) {
            return;
        }

        $definition = $container->findDefinition('Bits\DevVitaBundle\Service\ComposerInfoFetcher');
        $definition->setPublic(true);
        $definition->addTag('container.service_subscriber');
        
    }
}
