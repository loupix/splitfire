<?php

namespace App\Repository;

use App\Entity\Tweet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tweet|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tweet|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tweet[]    findAll()
 * @method Tweet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TweetRepository extends ServiceEntityRepository
{

    /** @var EntityManagerInterface */
    protected $em;


    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tweet::class);
    }

    private function get($author, $message){
        return $this->createQueryBuilder('t')
            ->where("t.author=:author")
            ->andWhere("t.message=:message")
            ->setParameter("author", $author)
            ->setParameter("message", $message)
            ->getQuery()
            ->getOneOrNullResult();
    }


    private function add($author, $message, $hashtags){
        $tweet = new Tweet();
        $tweet->setAuthor($author);
        $tweet->setMessage($message);
        $tweet->setAuthor($author);
        foreach ($hashtags as $tag)
            $tweet->addHashtags($tag);

        $em = $this->getEntityManager();
        $em->persist($tweet);
        $em->flush();
    }

    public function getOrCreate($author, $message, $hashtags){
        $tweet = $this->get($author, $message);
        if(is_null($tweet)){
            $this->add($author, $message, $hashtags);
            return $this->get($author, $message);
        }else
            return $tweet;
    }


    public function finder($author, $hashtags, $per_page, $page){
        $query = $this->createQueryBuilder('t')
            ->innerJoin("t.hashtags","h");

        if(!is_null($author))
            $query = $query->andWhere("t.author LIKE :author")->setParameter("author", "%".$author."%");
        if(!is_null($hashtags)){
            foreach ($hashtags as $tag) {
                $query = $query->andWhere("h.value LIKE :tag")->setParameter("tag", "%".$tag."%");
            }
        }

        return $query->getQuery()
            ->setMaxResults($per_page)
            ->setFirstResult(($page-1)*$per_page)
            ->getResult();
    }
}
