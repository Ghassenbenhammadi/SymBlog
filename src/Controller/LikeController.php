<?php

namespace App\Controller;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LikeController extends AbstractController
{
    #[Route('/like/article/{id}', name: 'app_like')]
    public function index(
        Post $post,
        EntityManagerInterface $manager
        
    ): Response
    {
        $user = $this->getUser();
        if($post->isLikedByUser($user)){
            $post->removeLike($user);
            $manager->flush();
            return $this->json([
                'message' => 'le like a été supprimé',
                'nbLike'  => $post->howManyLikes()
        
            ]);
        }

        $post->addLike($user);
        $manager->flush();
        return $this->json([
            'message' => 'le like a été ajouté',
            'nbLike'  => $post->howManyLikes()
        ]);
    }
}
