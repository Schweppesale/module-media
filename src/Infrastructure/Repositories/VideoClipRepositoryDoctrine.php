<?php
namespace Schweppesale\Module\Media\Infrastructure\Repositories;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NoResultException;
use Schweppesale\Module\Media\Domain\Entities\Video;
use Schweppesale\Module\Media\Domain\Repositories\VideoClipRepository;
use Schweppesale\Module\Core\Collections\Collection;
use Schweppesale\Module\Core\Exceptions\EntityNotFoundException;
use Schweppesale\Module\Media\Domain\Entities\File;
use Schweppesale\Module\Media\Domain\Entities\VideoClip;

/**
 * Class VideoClipRepositoryDoctrine
 * @package Schweppesale\Module\Media\Infrastructure\Repositories
 */
class VideoClipRepositoryDoctrine implements VideoClipRepository
{

    /**
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     * VideoClipRepositoryDoctrine constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        $this->manager = $registry->getManagerForClass(VideoClip::class);
    }

    public function findAll()
    {
        $result = $this->manager->createQueryBuilder()
            ->select('vc')
            ->from(VideoClip::class, 'vc')
            ->innerJoin(Video::class, 'v')
            ->getQuery()
            ->getResult();

        return new Collection($result);
    }

    /**
     * @param $videoId
     * @return VideoClip[]|Collection
     */
    public function findByVideoId($videoId)
    {
        $result = $this->manager->createQueryBuilder()
            ->select('vc')
            ->from(VideoClip::class, 'vc')
            ->where('vc.video = :id')
            ->setParameter('id', $videoId)
            ->getQuery()
            ->getResult();

        return new Collection($result);
    }

    /**
     * @param $userId
     * @return VideoClip[]|Collection
     */
    public function findByUserId($userId)
    {
        $result = $this->manager->createQueryBuilder()
            ->select('vc')
            ->from(VideoClip::class, 'vc')
            ->innerJoin(Video::class, 'v')
            ->where('vc.userId = :userId')
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getResult();

        return new Collection($result);
    }

    /**
     * @param $clipId
     * @return VideoClip
     * @throws EntityNotFoundException
     */
    public function getById($clipId): VideoClip
    {
        try {

            return $this->manager->createQueryBuilder()
                ->select('vc')
                ->from(VideoClip::class, 'vc')
                ->innerJoin(Video::class, 'v')
                ->where('vc.id = :id')
                ->setParameter('id', $clipId)
                ->getQuery()
                ->getSingleResult();

        } catch (NoResultException $ex) {
            throw new EntityNotFoundException('VideoClip not found!', 0, $ex);
        }
    }

    /**
     * @param VideoClip $clip
     * @return VideoClip
     */
    public function save(VideoClip $clip): VideoClip
    {
        $this->manager->persist($clip);
        $this->manager->flush();
        return $clip;
    }
}