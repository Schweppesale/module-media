<?php namespace Schweppesale\Module\Media\Application\Providers;

use Papper\MemberOption\Ignore;
use Papper\Papper;
use Schweppesale\Module\Core\Mapper\MapperInterface;
use Schweppesale\Module\Core\Mapper\Papper\Mapper;
use Schweppesale\Module\Media\Application\Response\FileDTO;
use Schweppesale\Module\Media\Application\Response\VideoClipDTO;
use Schweppesale\Module\Media\Application\Response\VideoDTO;
use Schweppesale\Module\Media\Domain\Entities\File;
use Schweppesale\Module\Media\Domain\Entities\Video;
use Schweppesale\Module\Media\Domain\Entities\VideoClip;
use Schweppesale\Module\Media\Domain\Repositories\FileRepository;
use Schweppesale\Module\Media\Domain\Repositories\VideoClipRepository;
use Schweppesale\Module\Media\Domain\Repositories\VideoRepository;
use Schweppesale\Module\Core\Providers\Laravel\ServiceProvider;
use Schweppesale\Module\Media\Domain\Services\FileManager;
use Schweppesale\Module\Media\Infrastructure\Repositories\FileRepositoryDoctrine;
use Schweppesale\Module\Media\Infrastructure\Repositories\VideoClipRepositoryDoctrine;
use Schweppesale\Module\Media\Infrastructure\Repositories\VideoRepositoryDoctrine;
use Schweppesale\Module\Media\Infrastructure\Services\FileManagerFlySystem;

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
        $this->registerMappings();
        $this->registerServices();
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

    public function registerMappings()
    {
        $this->app->singleton(MapperInterface::class, Mapper::class);

        Papper::createMap(File::class, FileDTO::class)
            ->ignoreAllNonExisting()
            ->constructUsing(function (File $file) {
                return new FileDTO(
                    $file->getId(),
                    $file->getUserId(),
                    $file->getHash(),
                    $file->getDisk(),
                    $file->getPath(),
                    $file->getSize(),
                    $file->getMimeType(),
                    $file->getCreatedAt(),
                    $file->getUpdatedAt()
                );
            });

        Papper::createMap(Video::class, VideoDTO::class)
            ->ignoreAllNonExisting()
            ->constructUsing(function (Video $video) {
                $file = Papper::map($video->getFile(), File::class)->toType(FileDTO::class);
                return new VideoDTO(
                    $video->getId(),
                    $file,
                    $video->getTitle(),
                    $video->getSourceId(),
                    $video->getCreatedAt(),
                    $video->getUpdatedAt()
                );
            });

        Papper::createMap(VideoClip::class, VideoClipDTO::class)
            ->ignoreAllNonExisting()
            ->constructUsing(function (VideoClip $clip) {
                return new VideoClipDTO(
                    $clip->getId(),
                    $clip->getVideo()->getId(),
                    $clip->getTitle(),
                    $clip->getUserId(),
                    $clip->getStartTime(),
                    $clip->getEndTime(),
                    $clip->getCreatedAt(),
                    $clip->getUpdatedAt()
                );
            });
    }

    /**
     * Register service provider bindings
     */
    public function registerRepositories()
    {
        $this->app->bind(FileRepository::class, FileRepositoryDoctrine::class);
        $this->app->bind(VideoRepository::class, VideoRepositoryDoctrine::class);
        $this->app->bind(VideoClipRepository::class, VideoClipRepositoryDoctrine::class);
    }

    public function registerServices()
    {
        $this->app->bind(FileManager::class, FileManagerFlySystem::class);
    }
}
