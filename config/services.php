<?php
namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use App\Service\FileUploader;

return static function (ContainerConfigurator $container) {
    $services = $configurator->services();

    $services->set(FileUploader::class)
        ->arg('$targetDirectory', '%depofichiers_directory%')
    ;
};