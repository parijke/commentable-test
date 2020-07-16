<?php

namespace App\Controller;

use App\Entity\Video;
use Faker\Factory;
use Faker\Generator;
use App\Entity\Comment;
use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProbeerController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var Generator
     */
    private $faker;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->faker = Factory::create();
    }

    /**
     * @Route("/probeer", name="probeer")
     */
    public function index()
    {
        $post = new Post();
        $post->setTitle($this->faker->title());
        $post->setBody($this->faker->realText());

        $this->entityManager->beginTransaction();
        $this->entityManager->persist($post);

        for($i = 0 ; $i < 10 ; $i++ ) {
            $comment = new Comment($post);
            $comment->setBody($this->faker->realText());
            $this->entityManager->persist($comment);
        }


        $this->entityManager->flush();
        $this->entityManager->commit();

        $video = new Video();
        $video->setTitle($this->faker->title());
        $video->setVideoUrl($this->faker->url());

        $this->entityManager->beginTransaction();
        $this->entityManager->persist($video);

        for($i = 0 ; $i < 10 ; $i++ ) {
            $comment = new Comment($video);
            $comment->setBody($this->faker->realText());
            $this->entityManager->persist($comment);
        }

        $this->entityManager->flush();
        $this->entityManager->commit();


        return $this->render('probeer/index.html.twig', [
            'controller_name' => 'ProbeerController',
        ]);
    }
}
