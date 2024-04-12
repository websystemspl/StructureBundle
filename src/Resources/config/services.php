<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Twig\Extension\StringLoaderExtension;
use Websystems\StructureBundle\Structure;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $container) {
    $services = $container->services()
        ->defaults()->private()
    ;

    $services
        ->set(Structure::class)->public()
            ->arg('$twig', service('twig'))
            ->arg('$container', service('service_container'))
            ->arg('$parameterBag', service('parameter_bag'))

        ->set(StringLoaderExtension::class)
    ;
};
