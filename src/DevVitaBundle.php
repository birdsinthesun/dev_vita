<?php
namespace Bits\DevVitaBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;
use Bits\DevVitaBundle\DependencyInjection\Compiler\MakeComposerInfoFetcherPublicPass;

class DevVitaBundle extends AbstractBundle
{
    
     public function build(ContainerBuilder $container): void
    {
        
         $projectDir = $container->getParameter('kernel.project_dir').'/vendor/birdsinthesun/dev_vita';
         $loader = new YamlFileLoader($container, new FileLocator($projectDir.'/config')); 
         $loader->load('services.yaml');
         $loader2 = new PhpFileLoader($container, new FileLocator($projectDir. '/config'));
         $loader2->load('bundles.php');
         
         parent::build($container);
         $container->addCompilerPass(new MakeComposerInfoFetcherPublicPass());
      
      
    }
  

}
