<?php
namespace Schweppesale\Module\Media\Domain\Entities;

use DateTime;
use Schweppesale\Module\Video\Domain\Values\UserId;

/**
 * Class Video
 * @package Schweppesale\Module\Media\Domain\Entities
 */
class Video
{

    /**
     * @var DateTime
     */
    private $createdAt;
    /**
     * @var File
     */
    private $file;
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
     * @var int|null
     */
    private $sourceId;

    /**
     * Video constructor.
     * @param File $file
     * @param string $title
     * @param int $sourceId
     */
    public function __construct(File $file, string $title, int $sourceId = null)
    {
        $this->file = $file;
        $this->title = $title;
        $this->sourceId = $sourceId;
        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return File
     */
    public function getFile(): File
    {
        return $this->file;
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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @return int|null
     */
    public function getSourceId()
    {
        return $this->sourceId;
    }

    public function preUpdate()
    {
        $this->updatedAt = new DateTime();
    }
}