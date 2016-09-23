<?php
namespace Schweppesale\Module\Access\Presentation\Providers;

use Hateoas\HateoasBuilder;
use Hateoas\UrlGenerator\CallableUrlGenerator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use Schweppesale\Module\Access\Domain\Exceptions\UnauthorizedException;
use Schweppesale\Module\Core\Exceptions\EntityNotFoundException;
use Schweppesale\Module\Core\Providers\Laravel\ServiceProvider;

class PresentationServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerExceptionHandlers();
    }

    /**
     * @return void
     */
    public function registerExceptionHandlers()
    {
    }
}