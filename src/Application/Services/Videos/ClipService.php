<?php
namespace Schweppesale\Module\Media\Application\Services\Videos;

use FFMpeg\Coordinate\TimeCode;
use FFMpeg\Exception\RuntimeException;
use FFMpeg\Format\Video\WebM;
use Schweppesale\Module\Core\Collections\Collection;
use Schweppesale\Module\Core\Mapper\MapperInterface;
use Schweppesale\Module\Media\Application\Response\VideoClipDTO;
use Schweppesale\Module\Media\Application\Response\VideoDTO;
use Schweppesale\Module\Media\Application\Services\Files\FileService;
use Schweppesale\Module\Media\Domain\Entities\VideoClip;
use Schweppesale\Module\Media\Domain\Repositories\VideoClipRepository;
use Schweppesale\Module\Media\Domain\Repositories\VideoRepository;
use Schweppesale\Module\Core\Exceptions\ApplicationException;
use Schweppesale\Module\Media\Domain\Entities\Video;

/**
 * Class ClipService
 * @package Schweppesale\Module\Media\Application\Services\Videos
 */
class ClipService
{

    /**
     * @var VideoRepository
     */
    private $videos;

    /**
     * @var VideoClipRepository
     */
    private $clips;

    /**
     * @var MapperInterface
     */
    private $mapper;

    /**
     * ClipService constructor.
     * @param MapperInterface $mapper
     * @param VideoRepository $videos
     * @param VideoClipRepository $clips
     */
    public function __construct(MapperInterface $mapper, VideoRepository $videos, VideoClipRepository $clips)
    {
        $this->mapper = $mapper;
        $this->videos = $videos;
        $this->clips = $clips;
    }

    /**
     * @param $videoId
     * @param $title
     * @param $startTime
     * @param $endTime
     * @return VideoClipDTO
     */
    public function create($videoId, $title, $startTime, $endTime)
    {
        $userId = 1;
        $video = $this->videos->getById($videoId);
        $videoClip = new VideoClip($video, $userId, $title, $startTime, $endTime);
        $clip = $this->clips->save($videoClip);
        return $this->mapper->map($clip, VideoClipDTO::class);
    }

    /**
     * @param $videoId
     * @return VideoClip[]
     */
    public function findByVideoId($videoId) {
        $result = $this->clips->findByVideoId($videoId);
        return $this->mapper->mapCollection($result, VideoClip::class, VideoClipDTO::class);
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
     * @return VideoClipDTO[]
     */
    public function findAll()
    {
        $result = $this->clips->findAll();
        return $this->mapper->mapCollection($result, VideoClip::class, VideoClipDTO::class);
    }

    /**
     * @param $videoId
     * @return VideoClipDTO
     */
    public function getById($videoId)
    {
        $clip = $this->clips->getById($videoId);
        return $this->mapper->map($clip, VideoClipDTO::class);
    }
}