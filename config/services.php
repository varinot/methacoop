<?php
namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use App\Service\FileUploader;

return static function (ContainerConfigurator $configurator) {
    $services = $configurator->services();

    $services->set(FileUploader::class)
        ->arg('$targetDirectory', '%depofichiers_directory%')
    ;
};