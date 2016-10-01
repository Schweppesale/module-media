<?php
namespace Schweppesale\Module\Media\Presentation\Providers;

use Hateoas\HateoasBuilder;
use Hateoas\UrlGenerator\CallableUrlGenerator;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use Schweppesale\Module\Core\Providers\Laravel\ServiceProvider;

class PresentationServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(SerializerInterface::class, function () {
            $metadata = realpath(__DIR__ . '/../Serializers/Hateoaes');
            $serializer = SerializerBuilder::create()->addMetadataDir($metadata);
            return HateoasBuilder::create($serializer)
                ->addMetadataDir($metadata)
                ->setDebug(env('APP_DEBUG', false))
//                ->setCacheDir(storage_path())
                ->setUrlGenerator(null, new CallableUrlGenerator(function ($route, array $parameters, $absolute) {
                    return route($route, $parameters, $absolute);
                }))
                ->build();
        });

        $this->registerExceptionHandlers();
    }

    /**
     * @return void
     */
    public function registerExceptionHandlers()
    {
    }
}