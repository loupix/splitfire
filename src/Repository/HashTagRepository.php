<?php

namespace App\Repository;

use App\Entity\HashTag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HashTag|null find($id, $lockMode = null, $lockVersion = null)
 * @method HashTag|null findOneBy(array $criteria, array $orderBy = null)
 * @method HashTag[]    findAll()
 * @method HashTag[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HashTagRepository extends ServiceEntityRepository
{

    /** @var EntityManagerInterface */
    protected $em;


    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HashTag::class);
    }


    private function get($value){
        return $this->createQueryBuilder('h')
            ->where("h.value=:value")
            ->setParameter("value", $value)
            ->getQuery()
            ->getOneOrNullResult();
    }


    private function add($value){
        $hash = new HashTag();
        $hash->setValue($value);

        $em = $this->getEntityManager();
        $em->persist($hash);
        $em->flush();
    }

    public function getOrCreate($value){
        $hash = $this->get($value);
        if(is_null($hash)){
            $this->add($value);
            return $this->get($value);
        }else
            return $hash;
    }
}
