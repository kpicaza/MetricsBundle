<?php

namespace Kpicaza\Bundle\MetricsBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Kpicaza\Bundle\MetricsBundle\DependencyInjection\Compiler\RegisterMetricsListenersPass;

class KpicazaMetricsBundle extends Bundle
{

    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new RegisterMetricsListenersPass());
    }

}
