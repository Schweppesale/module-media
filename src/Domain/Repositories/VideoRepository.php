<?php
namespace Schweppesale\Module\Media\Domain\Repositories;

use Schweppesale\Module\Core\Collections\Collection;
use Schweppesale\Module\Core\Exceptions\EntityNotFoundException;
use Schweppesale\Module\Media\Domain\Entities\Video;

/**
 * Interface VideoRepository
 * @package Schweppesale\Module\Media\Domain\Repositories
 */
interface VideoRepository
{

    /**
     * @param $userId
     * @return Video[]|Collection
     */
    public function findByUserId($userId);

    /**
     * @param $sourceId
     * @return Video[]|Collection
     */
    public function findBySourceId($sourceId);

    /**
     * @return Video[]|Collection
     */
    public function findAll();

    /**
     * @param $videoId
     * @return Video
     * @throws EntityNotFoundException
     */
    public function getById($videoId): Video;

    /**
     * @param Video $video
     * @return Video
     */
    public function save(Video $video): Video;
}