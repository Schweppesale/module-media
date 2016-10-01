<?php
namespace Schweppesale\Module\Media\Domain\Entities;

use DateTime;

/**
 * Class VideoClip
 * @package Schweppesale\Module\Media\Domain\Entities
 */
class VideoClip
{

    /**
     * @var DateTime
     */
    private $createdAt;

    /**
     * @var Video
     */
    private $video;

    /**
     * @var int
     */
    private $userId;

    /**
     * @var int
     */
    private $startTime;

    /**
     * @var int
     */
    private $endTime;
    /**
     * @var int|null
     */
    private $id;
    /**
     * @var string
     */
    private $title;
    /**
     * @var DateTime
     */
    private $updatedAt;

    /**
     * VideoClip constructor.
     * @param Video $video
     * @param $userId
     * @param $title
     * @param $startTime
     * @param $endTime
     */
    public function __construct(Video $video, $userId, $title, $startTime, $endTime)
    {
        $this->video = $video;
        $this->userId = $userId;
        $this->title = $title;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return Video
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return int
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * @return int
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}