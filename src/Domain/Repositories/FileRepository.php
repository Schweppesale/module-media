<?php
namespace Schweppesale\Module\Media\Domain\Repositories;

use Schweppesale\Module\Core\Exceptions\EntityNotFoundException;
use Schweppesale\Module\Media\Domain\Entities\File;

/**
 * Interface FileRepository
 * @package Schweppesale\Module\Media\Domain\Repositories
 */
interface FileRepository
{

    /**
     * @param $fileId
     * @return File
     * @throws EntityNotFoundException
     */
    public function getById($fileId): File;

    /**
     * @param File $file
     * @return File
     */
    public function save(File $file): File;
}