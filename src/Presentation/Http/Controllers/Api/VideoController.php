<?php
namespace Schweppesale\Module\Media\Presentation\Http\Controllers\Api;

use Illuminate\Http\Request;
use Schweppesale\Module\Media\Application\Services\Videos\VideoService;
use Schweppesale\Module\Media\Infrastructure\Services\FileManagerFlySystem;
use Schweppesale\Module\Media\Presentation\Services\Api\Response;

/**
 * Class VideoController
 * @package Schweppesale\Module\Media\Presentation\Http\Controllers\Api
 */
class VideoController
{

    /**
     * @var Response
     */
    private $response;

    /**
     * @var VideoService
     */
    private $videoService;
    /**
     * VideoController constructor.
     * @param Response $response
     * @param VideoService $videoService
     */
    public function __construct(Response $response, VideoService $videoService)
    {
        $this->response = $response;
        $this->videoService = $videoService;
    }

    public function index()
    {
        return $this->response->format($this->videoService->findAll());
    }

    public function clips(Request $request)
    {
        $sourceId = $request->get('sourceId');
        return $this->response->format($this->videoService->findBySourceId($sourceId));
    }

    public function show($videoId)
    {
        return $this->response->format($this->videoService->getById($videoId));
    }

    public function store(Request $request)
    {
        $host = 'public';
        $title = $request->get('title');
        $video = $request->file('video');
        $filename = $video->getClientOriginalName() ?: md5(uniqid());
        $resource = fopen($video->getPathname(), 'r');
        $mimeType = $video->getMimeType();

        return $this->response->format(
            $this->videoService->create($host, $filename, $resource, $mimeType, ['title' => $title])
        );
    }
}