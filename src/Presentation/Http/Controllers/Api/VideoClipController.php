<?php
namespace Schweppesale\Module\Media\Presentation\Http\Controllers\Api;

use Illuminate\Http\Request;
use Metadata\Tests\Driver\Fixture\C\SubDir\C;
use Schweppesale\Module\Media\Application\Services\Videos\ClipService;
use Schweppesale\Module\Media\Presentation\Services\Api\Response;

/**
 * Class VideoClipController
 * @package Schweppesale\Module\Media\Presentation\Http\Controllers\Api
 */
class VideoClipController
{

    /**
     * @var Response
     */
    private $response;

    /**
     * @var ClipService
     */
    private $clipService;

    /**
     * VideoController constructor.
     * @param Response $response
     * @param ClipService $clipService
     */
    public function __construct(Response $response, ClipService $clipService)
    {
        $this->response = $response;
        $this->clipService = $clipService;
    }

    public function index()
    {
        return $this->response->format($this->clipService->findAll());
    }

    /**
     * @param $videoId
     * @return \Illuminate\Http\Response
     */
    public function indexByVideo($videoId)
    {
        return $this->response->format($this->clipService->findByVideoId($videoId));
    }

    /**
     * @param $clipId
     * @return \Illuminate\Http\Response
     */
    public function show($clipId)
    {
        return $this->response->format($this->clipService->getById($clipId));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->response->format(
            $this->clipService->create(
                $request->get('videoId'),
                $request->get('title', 'Untitled'),
                $request->get('startTime'),
                $request->get('endTime')
            )
        );
    }
}