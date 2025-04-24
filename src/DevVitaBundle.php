<?php
namespace Bits\DevVitaBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class DevVitaBundle extends AbstractBundle
{
    
     public function build(ContainerBuilder $container): void
    {
        
         $projectDir = $container->getParameter('kernel.project_dir').'/vendor/birdsinthesun/fly_ux';
         $loader = new YamlFileLoader($container, new FileLocator($projectDir.'/config')); 
         $loader->load('services.yaml');
         $loader2 = new PhpFileLoader($container, new FileLocator($projectDir. '/config'));
         $loader2->load('bundles.php');
         
         parent::build($container);
      
      
    }
  

}
