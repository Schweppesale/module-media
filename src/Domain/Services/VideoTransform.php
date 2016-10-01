<?php
namespace Schweppesale\Module\Media\Domain\Services;

use Schweppesale\Module\Media\Domain\Entities\Video;

/**
 * Interface VideoTransform
 * @package Schweppesale\Module\Media\Domain\Services
 */
interface VideoTransform {


    public function crop(Video $video, $start, $duration, $destination);
}