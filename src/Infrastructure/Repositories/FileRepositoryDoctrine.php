<?php
namespace Schweppesale\Module\Media\Infrastructure\Repositories;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NoResultException;
use Schweppesale\Module\Media\Domain\Repositories\FileRepository;
use Schweppesale\Module\Core\Exceptions\EntityNotFoundException;
use Schweppesale\Module\Media\Domain\Entities\File;

/**
 * Class FileRepositoryDoctrine
 * @package Schweppesale\Module\Media\Infrastructure\Repositories
 */
class FileRepositoryDoctrine implements FileRepository
{

    /**
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     * FileRepositoryDoctrine constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        $this->manager = $registry->getManagerForClass(File::class);
    }

    public function getById($fileId): File
    {
        try {

            return $this->manager->createQueryBuilder()
                ->select('f')
                ->from(File::class, 'f')
                ->where('f.id = :id')
                ->setParameter('id', $fileId)
                ->getQuery()
                ->getSingleResult();

        } catch (NoResultException $ex) {
            throw new EntityNotFoundException('File not found!', 0, $ex);
        }
    }

    public function getByVideoId($videoId): File
    {
        // TODO: Implement getByVideoId() method.
    }

    /**
     * @param File $file
     * @return File
     */
    public function save(File $file): File
    {
        $this->manager->persist($file);
        $this->manager->flush();
        return $file;
    }
}