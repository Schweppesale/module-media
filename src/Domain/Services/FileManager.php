<?php
namespace Schweppesale\Module\Media\Domain\Services;

/**
 * Interface FileManager
 * @package Schweppesale\Module\Media\Domain\Services
 */
interface FileManager
{

    /**
     * @param $disk
     * @param $path
     * @return mixed
     */
    public function delete($disk, $path);

    /**
     * @param $disk
     * @param $path
     * @return bool
     */
    public function exists($disk, $path): bool;

    /**
     * @param $disk
     * @param $path
     * @return mixed
     */
    public function getSize($disk, $path);

    /**
     * @param $disk
     * @param $path
     * @param resource $resource
     * @param $visibility
     * @return mixed
     */
    public function put($disk, $path, $resource, $visibility = null);

    /**
     * @param $disk
     * @param $path
     * @return string
     */
    public function url($disk, $path): string;
}