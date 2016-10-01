<?php
namespace Schweppesale\Module\Media\Application\Response;

use DateTime;
use Schweppesale\Module\Media\Domain\Entities\Video;

/**
 * Class FileDTO
 * @package Schweppesale\Module\Media\Application\Response
 */
class FileDTO {

    /**
     * @var DateTime
     */
    private $createdAt;

    /**
     * @var string
     */
    private $disk;
    /**
     * @var null|int
     */
    private $id;
    /**
     * @var string
     */
    private $path;
    /**
     * @var int
     */
    private $size;
    /**
     * @var DateTime
     */
    private $updatedAt;
    /**
     * @var int
     */
    private $userId;

    /**
     * @var string
     */
    private $hash;

    /**
     * @var string
     */
    private $mimeType;

    /**
     * @var string
     */
    private $url;

    /**
     * FileDTO constructor.
     * @param $id
     * @param $userId
     * @param $hash
     * @param $disk
     * @param $path
     * @param $size
     * @param $mimeType
     * @param DateTime $createdAt
     * @param DateTime $updatedAt
     */
    public function __construct($id, $userId, $hash, $disk, $path, $size, $mimeType, DateTime $createdAt, DateTime $updatedAt)
    {
        $this->createdAt = $createdAt;
        $this->disk = $disk;
        $this->id = $id;
        $this->path = $path;
        $this->size = $size;
        $this->updatedAt = $updatedAt;
        $this->userId = $userId;
        $this->hash = $hash;
        $this->mimeType = $mimeType;
    }

    /**
     * @return string
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getDisk()
    {
        return $this->disk;
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
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }
}