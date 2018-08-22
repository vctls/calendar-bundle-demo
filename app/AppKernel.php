<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new FOS\JsRoutingBundle\FOSJsRoutingBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new ADesigns\CalendarBundle\ADesignsCalendarBundle(),
            new AppBundle\AppBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'), true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
            $bundles[] = new Vctls\EntityBundle\VctlsEntityBundle();
        }

        return $bundles;
    }

    /**
     * @param LoaderInterface $loader
     * @throws Exception
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }

    /**
     * @return string
     */
    public function getCacheDir()
    {
        // Si un fichier 'env.php' existe, essayer de l'inclure
        // et récupérer le répertoire de cache.
        // Cette opération doit être faite depuis la classe Kernel
        // et pas depuis le point d'entrée app_dev.php, parce que
        // les opérations en ligne de commande n'en tiennent pas compte.
        $envFile = __DIR__.'/config/env.php';
        if (file_exists($envFile)) {
            include $envFile;
            if (isset($cacheDir)) {
                return $cacheDir .  $this->environment;
            }
        }

        return parent::getCacheDir();
    }

    /**
     * @return string
     */
    public function getLogDir()
    {
        $envFile = __DIR__.'/config/env.php';
        if (file_exists($envFile)) {
            include $envFile;
            if (isset($logDir)) {
                return $logDir .  $this->environment;
            }
        }

        return parent::getLogDir();
    }
}
