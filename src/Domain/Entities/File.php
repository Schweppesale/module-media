<?php
namespace Schweppesale\Module\Media\Domain\Entities;

use DateTime;
use Schweppesale\Module\Core\Exceptions\DomainException;
use Schweppesale\Module\Media\Domain\Services\FileManager;
use Schweppesale\Module\Video\Domain\Values\UserId;

/**
 * Class File
 * @package Schweppesale\Module\Media\Domain\Entities
 */
class File
{
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
     * File constructor.
     * @param int $userId
     * @param FileManager $fileManager
     * @param string $disk
     * @param string $path
     * @throws DomainException
     */
    public function __construct(FileManager $fileManager, int $userId, string $disk, string $path, $mimeType)
    {
        if($fileManager->exists($disk, $path) === false) {
            throw new DomainException('File does not exist on ' . $disk . '!');
        }

        $this->size = $fileManager->getSize($disk, $path);
        $this->mimeType = $mimeType;

        $this->disk = $disk;
        $this->path = $path;
        $this->userId = $userId;
        $this->hash = md5(base_path($path));

        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
    }

    /**
     * @return string
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * @return string
     */
    public function getDisk(): string
    {
        return $this->disk;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param FileManager $fileManager
     * @return string
     */
    public function url(FileManager $fileManager)
    {
        return $fileManager->url($this->disk, $this->path);
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    public function preUpdate()
    {
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
     * @return DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }
}
