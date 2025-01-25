<?php

namespace App\Repository;

use App\Entity\Activity;
use App\Entity\ActivityType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @extends ServiceEntityRepository<Activity>
 *
 * @method Activity|null find($id, $lockMode = null, $lockVersion = null)
 * @method Activity|null findOneBy(array $criteria, array $orderBy = null)
 * @method Activity[]    findAll()
 * @method Activity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActivityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Activity::class);
    }

    public function add(Activity $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Activity $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findLastActivities(UserInterface $user, ActivityType $activityType, ?int $numberLastActivities): array
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.activityType = :activityType')
            ->andWhere('a.userLink = :user')
            ->setMaxResults($numberLastActivities)
            ->orderBy('a.departureTime', 'DESC')
            ->setParameters(new ArrayCollection([
                new Parameter('activityType', $activityType),
                new Parameter('user', $user)
            ]))
            ->getQuery()
            ->getResult();
    }

    public function findActivitiesByYear(UserInterface $user, string $year, ActivityType $activityType): array
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.activityType = :activityType')
            ->andWhere('a.userLink = :user')
            ->andWhere('YEAR(a.departureTime) = :year')
            ->setParameters(new ArrayCollection([
                new Parameter('year', $year),
                new Parameter('user', $user),
                new Parameter('activityType', $activityType)
            ]))
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Activity[] Returns an array of Activity objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Activity
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
