<?php
namespace Schweppesale\Module\Media\Application\Services\Videos;

use FFMpeg\Coordinate\TimeCode;
use FFMpeg\Exception\RuntimeException;
use FFMpeg\Format\Video\WebM;
use Illuminate\Routing\UrlGenerator;
use Schweppesale\Module\Core\Collections\Collection;
use Schweppesale\Module\Core\Mapper\MapperInterface;
use Schweppesale\Module\Media\Application\Response\VideoDTO;
use Schweppesale\Module\Media\Application\Services\Files\FileService;
use Schweppesale\Module\Media\Domain\Entities\VideoClip;
use Schweppesale\Module\Media\Domain\Repositories\VideoRepository;
use Schweppesale\Module\Core\Exceptions\ApplicationException;
use Schweppesale\Module\Media\Domain\Entities\Video;
use Schweppesale\Module\Media\Domain\Services\FileManager;

/**
 * Class VideoService
 * @package Schweppesale\Module\Media\Application\Services\Videos
 */
class VideoService
{

    /**
     * @var FileService
     */
    private $fileService;
    /**
     * @var VideoRepository
     */
    private $videos;

    /**
     * @var MapperInterface
     */
    private $mapper;

    /**
     * @var FileManager
     */
    private $fileManager;

    /**
     * @var ClipService
     */
    private $clipService;

    /**
     * VideoService constructor.
     * @param MapperInterface $mapper
     * @param FileManager $fileManager
     * @param FileService $fileService
     * @param VideoRepository $videos
     * @param ClipService $clipService
     */
    public function __construct(
        MapperInterface $mapper,
        FileManager $fileManager,
        FileService $fileService,
        VideoRepository $videos,
        ClipService $clipService
    ) {
        $this->fileService = $fileService;
        $this->videos = $videos;
        $this->mapper = $mapper;
        $this->fileManager = $fileManager;
        $this->clipService = $clipService;
    }

    /**
     * @param VideoDTO $video
     * @return VideoDTO
     */
    public function expand(VideoDTO $video)
    {
        $file = $this->fileService->expand($video->getFile());
        $video->setFiles($file);

        $clips = $this->clipService->findByVideoId($video->getId());
        $video->setClips($clips);

        return $video;
    }

    /**
     * @param string $disk
     * @param string $filename
     * @param resource $resource
     * @param array $parameters
     * @return VideoDTO
     */
    public function create(string $disk, string $filename, $resource, $mimeType, array $parameters = [])
    {
        $sourceId = array_key_exists('sourceId', $parameters) ? $parameters['sourceId'] : 0;
        $title = array_key_exists('title', $parameters) ? $parameters['title'] : 'Untitled';
        $file = $this->fileService->create($disk, $filename, $resource, $mimeType);
        $video = new Video($file, $title, $sourceId);

        return $this->expand($this->mapper->map($this->videos->save($video), VideoDTO::class));
    }

    /**
     * Returns a URL to post file
     *
     * @return array
     */
    public function createMeta()
    {
        return [
            'destination' => route('videos.store')
        ];
    }

    /**
     * @param $sourceId
     * @return VideoDTO[]
     */
    public function findBySourceId($sourceId)
    {
        $result = $this->videos->findBySourceId($sourceId);
        return array_map([$this, 'expand'], $this->mapper->mapCollection($result, Video::class, VideoDTO::class));
    }

    /**
     * @param $userId
     * @return VideoDTO[]
     */
    public function findByUserId($userId)
    {
        $result = $this->videos->findByUserId($userId);
        return array_map([$this, 'expand'], $this->mapper->mapCollection($result, Video::class, VideoDTO::class));
    }

    /**
     * @param $userId
     * @return VideoDTO[]
     */
    public function findAll()
    {
        $result = $this->videos->findAll();
        return array_map([$this, 'expand'], $this->mapper->mapCollection($result, Video::class, VideoDTO::class));
    }

    /**
     * @param $videoId
     * @return VideoDTO
     */
    public function getById($videoId)
    {
        $video = $this->videos->getById($videoId);
        return $this->expand($this->mapper->map($video, VideoDTO::class));
    }
}