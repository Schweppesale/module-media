<?php
namespace Schweppesale\Module\Media\Application\Response;

use DateTime;
use Schweppesale\Module\Media\Application\Response\VideoDTO;

class VideoClipDTO {

    /**
     * @var DateTime
     */
    private $createdAt;

    /**
     * @var int
     */
    private $videoId;

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
     * VideoClipDTO constructor.
     * @param $id
     * @param int $videoId
     * @param $title
     * @param $userId
     * @param $startTime
     * @param $endTime
     * @param DateTime $createdAt
     * @param DateTime $updatedAt
     */
    public function __construct($id, $videoId, $title, $userId, $startTime, $endTime, DateTime $createdAt, DateTime $updatedAt)
    {
        $this->createdAt = $createdAt;
        $this->videoId = $videoId;
        $this->userId = $userId;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->id = $id;
        $this->title = $title;
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return int
     */
    public function getVideoId()
    {
        return $this->videoId;
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