<?php
namespace Schweppesale\Module\Media\Application\Services\Files;

use Schweppesale\Module\Access\Application\Services\Users\AuthenticationService;
use Schweppesale\Module\Media\Application\Response\FileDTO;
use Schweppesale\Module\Media\Domain\Repositories\FileRepository;
use Schweppesale\Module\Media\Domain\Entities\File;
use Schweppesale\Module\Media\Domain\Services\FileManager;

/**
 * Class FileService
 * @package Schweppesale\Module\Media\Application\Services
 */
class FileService
{

    /**
     * @var AuthenticationService
     */
    private $auth;

    /**
     * @var FileManager
     */
    private $fileManager;

    /**
     * @var FileRepository
     */
    private $files;

    /**
     * FileService constructor.
     * @param AuthenticationService $auth
     * @param FileManager $fileManager
     * @param FileRepository $files
     */
    public function __construct(AuthenticationService $auth, FileManager $fileManager, FileRepository $files)
    {
        $this->auth = $auth;
        $this->fileManager = $fileManager;
        $this->files = $files;
    }

    /**
     * @param FileDTO $file
     * @return FileDTO
     */
    public function expand(FileDTO $file)
    {
        $file->setUrl($this->fileManager->url($file->getDisk(), $file->getPath()));

        return $file;
    }

    /**
     * @param string $disk
     * @param string $filename
     * @param $resource
     * @param $mimeType
     * @return File
     */
    public function create(string $disk, string $filename, $resource, $mimeType)
    {
        $userId = $this->auth->getUser()->getId();
        $destination = date('Y/m/d') . '/' . $filename;
        $this->fileManager->put($disk, $destination, $resource);
        $file = new File($this->fileManager, $userId, $disk, $destination, $mimeType);
        return $this->files->save($file);
    }
}