<?php

namespace App\Controller;

use App\Entity\HashTag;
use App\Entity\Tweet;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventsController extends AbstractController
{
    /**
     * @Route("/events", name="events")
     */
    public function index(Request $request)
    {
        return $this->json([
            'path' => 'index',
        ]);
    }

    private function getHashtags($string) {  
        $hashtags= FALSE;
        preg_match_all("/(#\w+)/u", $string, $matches);  
        if ($matches) {
            $hashtagsArray = array_count_values($matches[0]);
            $hashtags = array_keys($hashtagsArray);
        }
        return $hashtags;
    }

    /**
     * @Route("/events", name="events", condition="context.getMethod() in ['POST', 'PUT']")
     */
    public function add(Request $request){

        if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
            $data = json_decode($request->getContent(), true);
            $author = array_key_exists("author", $data) ? $data['author'] : null;
            $message = array_key_exists("message", $data) ? $data['message'] : null;
        }else{
            $author = $request->request->get('author');
            $message = $request->request->get('message');
        }




        if(is_null($author))
            return $this->json(['error'=>"No Author params"]);
        else if(is_null($message))
            return $this->json(['error'=>"No Message params"]);

        $em = $this->getDoctrine()->getManager();
        $hashtagRepository = $em->getRepository(HashTag::class);
        $tweetRepository = $em->getRepository(Tweet::class);


        // Create Hashtags

        $hashtags_values = $this->getHashtags($message);
        $hashtags=[];
        if($hashtags_values){
            foreach ($hashtags_values as $value) {
                $hashtags[] = $hashtagRepository->getOrCreate($value);
            }
        }


        // Create tweet
        $tweet = $tweetRepository->getOrCreate($author, $message, $hashtags);



        return $this->json($tweet->getId());
    }

    /**
     * @Route("/events", name="events", condition="context.getMethod() in ['GET', 'HEAD']")
     */
    public function view(Request $request){


        $author = $request->query->get('author');
        $hashtags = $request->query->get('hashtags');
        $page = $request->query->get('page');
        $per_page = $request->query->get('per_page');

        $page = is_null($page) ? 1 : $page;
        $per_page = is_null($per_page) ? 25 : $per_page;


        $em = $this->getDoctrine()->getManager();
        $tweetRepository = $em->getRepository(Tweet::class);

        $tweets = $tweetRepository->finder($author, $hashtags, $per_page, $page);


        return $this->json(array_map(function($tweet){
            return ['id'=>$tweet->getId(),
                'author'=>$tweet->getAuthor(),
                'message'=>$tweet->getMessage(),
                'hashtags'=>array_map(function($tag){return $tag->getValue();}, $tweet->getHashtags()->toArray()),
                'created'=>$tweet->getCreated()->format('Y-m-d H:i:s')];
        }, $tweets));

    }
}
