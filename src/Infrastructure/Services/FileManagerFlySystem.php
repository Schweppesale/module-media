<?php
namespace Schweppesale\Module\Media\Infrastructure\Services;

use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Filesystem\FilesystemManager;
use Schweppesale\Module\Media\Domain\Services\FileManager;

/**
 * Class FileManagerFlySystem
 * @package Schweppesale\Module\Media\Infrastructure\Services
 */
class FileManagerFlySystem implements FileManager
{

    /**
     * @var FilesystemManager
     */
    private $fileManger;

    /**
     * FileManagerFlySystem constructor.
     * @param FilesystemManager $fileManager
     */
    public function __construct(FilesystemManager $fileManager)
    {
        $this->fileManger = $fileManager;
    }

    /**
     * @param $diskr
     * @param $path
     * @return mixed
     */
    public function delete($diskr, $path)
    {
        return $this->fileManger->disk($diskr)->delete($path);
    }

    /**
     * @param $diskr
     * @param $path
     * @return bool
     */
    public function exists($diskr, $path): bool
    {
        return $this->fileManger->disk($diskr)->exists($path);
    }

    /**
     * @param $diskr
     * @param $path
     * @return mixed
     */
    public function getSize($diskr, $path)
    {
        return $this->fileManger->disk($diskr)->size($path);
    }

    /**
     * @param $diskr
     * @param $path
     * @param resource $resource
     * @param string $visibility
     * @return bool
     */
    public function put($diskr, $path, $resource, $visibility = null)
    {
        return $this->fileManger->disk($diskr)->put($path, $resource, $visibility);
    }


    /**
     * @param $disk
     * @param $path
     * @return string
     */
    public function url($disk, $path): string {
        if($disk === 'public') {
            return url('/media/' . $path);
        }

        return $this->fileManger->disk($disk)->url($path);
    }
}