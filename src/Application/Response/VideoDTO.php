<?php
namespace Schweppesale\Module\Media\Application\Response;

use DateTime;

/**
 * Class VideoDTO
 * @package Schweppesale\Module\Media\Application\Response
 */
class VideoDTO
{
    /**
     * @var DateTime
     */
    private $createdAt;

    /**
     * @var FileDTO
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
     * @var string
     */
    private $html;

    /**
     * @var string
     */
    private $url;

    /**
     * @var array
     */
    private $clips = [];

    /**
     * VideoDTO constructor.
     * @param $id
     * @param FileDTO $file
     * @param $title
     * @param $sourceId
     * @param DateTime $createdAt
     * @param DateTime $updatedAt
     */
    public function __construct($id, FileDTO $file, $title, $sourceId, DateTime $createdAt, DateTime $updatedAt)
    {
        $this->createdAt = $createdAt;
        $this->file = $file;
        $this->id = $id;
        $this->title = $title;
        $this->updatedAt = $updatedAt;
        $this->sourceId = $sourceId;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return FileDTO
     */
    public function getFile()
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
     * @return array
     */
    public function getClips()
    {
        return $this->clips;
    }


    /**
     * @param array $clips
     */
    public function setClips($clips)
    {
        $this->clips = $clips;
    }

    public function setFiles($file)
    {
        $this->file = $file;
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

    /**
     * @return int|null
     */
    public function getSourceId()
    {
        return $this->sourceId;
    }

    /**
     * @return string
     */
    public function getHtml()
    {
        return $this->html;
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
     * @param string $html
     */
    public function setHtml($html)
    {
        $this->html = $html;
    }
}