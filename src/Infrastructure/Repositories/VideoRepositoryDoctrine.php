<?php
namespace Schweppesale\Module\Media\Infrastructure\Repositories;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\Query\AST\Join;
use Schweppesale\Module\Media\Domain\Repositories\VideoRepository;
use Schweppesale\Module\Core\Collections\Collection;
use Schweppesale\Module\Core\Exceptions\EntityNotFoundException;
use Schweppesale\Module\Media\Domain\Entities\File;
use Schweppesale\Module\Media\Domain\Entities\Video;

/**
 * Class VideoRepositoryDoctrine
 * @package Schweppesale\Module\Media\Infrastructure\Repositories
 */
class VideoRepositoryDoctrine implements VideoRepository
{

    /**
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     * VideoRepositoryDoctrine constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        $this->manager = $registry->getManagerForClass(Video::class);
    }

    public function findAll()
    {
        $result = $this->manager->createQueryBuilder()
            ->select('v')
            ->from(Video::class, 'v')
            ->getQuery()
            ->getResult();

        return new Collection($result);
    }

    /**
     * @param $sourceId
     * @return Video[]|Collection
     */
    public function findBySourceId($sourceId)
    {
        $result = $this->manager->createQueryBuilder()
            ->select('v')
            ->from(Video::class, 'v')
            ->where('v.sourceId = :sourceId')
            ->setParameter('sourceId', $sourceId)
            ->getQuery()
            ->getResult();

        return new Collection($result);
    }

    /**
     * @param $userId
     * @return Video[]|Collection
     */
    public function findByUserId($userId)
    {
        $result = $this->manager->createQueryBuilder()
            ->select('v')
            ->from(Video::class, 'v')
            ->innerJoin(File::class, 'f')
            ->where('f.userId = :userId')
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getResult();

        return new Collection($result);
    }

    public function getByFileId($fileID): Video
    {
        // TODO: Implement getByFileId() method.
    }

    /**
     * @param $videoId
     * @return Video
     * @throws EntityNotFoundException
     */
    public function getById($videoId): Video
    {
        try {

            return $this->manager->createQueryBuilder()
                ->select('v')
                ->from(Video::class, 'v')
                ->where('v.id = :id')
                ->setParameter('id', $videoId)
                ->getQuery()
                ->getSingleResult();

        } catch (NoResultException $ex) {
            throw new EntityNotFoundException('Video not found!', 0, $ex);
        }
    }

    /**
     * @param Video $video
     * @return Video
     */
    public function save(Video $video): Video
    {
        $this->manager->persist($video);
        $this->manager->flush();
        return $video;
    }
}