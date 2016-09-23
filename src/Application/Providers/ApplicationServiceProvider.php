<?php namespace Schweppesale\Module\Access\Application\Providers;

use LaravelDoctrine\ORM\Auth\DoctrineUserProvider;
use Papper\Papper;
use Schweppesale\Module\Access\Application\Response\GroupDTO;
use Schweppesale\Module\Access\Application\Response\OrganisationDTO;
use Schweppesale\Module\Access\Application\Response\PermissionDTO;
use Schweppesale\Module\Access\Application\Response\RoleDTO;
use Schweppesale\Module\Access\Application\Response\UserDTO;
use Schweppesale\Module\Access\Domain\Entities\Group;
use Schweppesale\Module\Access\Domain\Entities\Organisation;
use Schweppesale\Module\Access\Domain\Entities\Permission;
use Schweppesale\Module\Access\Domain\Entities\Role;
use Schweppesale\Module\Access\Domain\Entities\User;
use Schweppesale\Module\Access\Domain\Repositories\GroupRepository as GroupRepositoryInterface;
use Schweppesale\Module\Access\Domain\Repositories\OrganisationRepository as OrganisationRepositoryInterface;
use Schweppesale\Module\Access\Domain\Repositories\PermissionRepository as PermissionRepositoryInterface;
use Schweppesale\Module\Access\Domain\Repositories\RoleRepository as RoleRepositoryInterface;
use Schweppesale\Module\Access\Domain\Repositories\UserRepository as UserRepositoryInterface;
use Schweppesale\Module\Access\Domain\Services\PasswordHasher;
use Schweppesale\Module\Access\Infrastructure\Repositories\Group\GroupRepositoryDoctrine;
use Schweppesale\Module\Access\Infrastructure\Repositories\Organisation\OrganisationRepositoryDoctrine;
use Schweppesale\Module\Access\Infrastructure\Repositories\Permission\PermissionRepositoryDoctrine;
use Schweppesale\Module\Access\Infrastructure\Repositories\Role\RoleRepositoryDoctrine;
use Schweppesale\Module\Access\Infrastructure\Repositories\User\UserRepositoryDoctrine;
use Schweppesale\Module\Access\Infrastructure\Services\PasswordHasher\PasswordHasherBcrypt;
use Schweppesale\Module\Core\Mapper\MapperInterface;
use Schweppesale\Module\Core\Mapper\Papper\Mapper;
use Schweppesale\Module\Core\Providers\Laravel\ServiceProvider;

class ApplicationServiceProvider extends ServiceProvider
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
        $this->registerConfig();
        $this->registerRepositories();
        $this->registerFacade();
        $this->registerMappings();
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__ . '/../Config/config.php' => config_path('media.php'),
        ]);

        $this->mergeConfigFrom(
            __DIR__ . '/../Config/config.php', 'media'
        );

        $this->mergeConfigRecursiveFrom(
            __DIR__ . '/../Config/doctrine.php', 'doctrine'
        );
    }

    /**
     * Register the vault facade without the user having to add it to the app.php file.
     *
     * @return void
     */
    public function registerFacade()
    {
    }

    public function registerMappings()
    {
        $this->app->singleton(MapperInterface::class, Mapper::class);
    }

    /**
     * Register service provider bindings
     */
    public function registerRepositories()
    {

    }
}
