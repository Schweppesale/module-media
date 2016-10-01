<?php
namespace Schweppesale\Module\Media\Domain\Repositories;

use Schweppesale\Module\Core\Collections\Collection;
use Schweppesale\Module\Core\Exceptions\EntityNotFoundException;
use Schweppesale\Module\Media\Domain\Entities\VideoClip;

/**
 * Interface VideoClipRepository
 * @package Schweppesale\Module\Media\Domain\Repositories
 */
interface VideoClipRepository
{

    /**
     * @param $userId
     * @return VideoClip[]|Collection
     */
    public function findByUserId($userId);

    /**
     * @param $videoId
     * @return VideoClip[]|Collection
     */
    public function findByVideoId($videoId);

    /**
     * @return VideoClip[]|Collection
     */
    public function findAll();

    /**
     * @param $clipId
     * @return VideoClip
     * @throws EntityNotFoundException
     */
    public function getById($clipId): VideoClip;

    /**
     * @param VideoClip $video
     * @return VideoClip
     */
    public function save(VideoClip $video): VideoClip;
}