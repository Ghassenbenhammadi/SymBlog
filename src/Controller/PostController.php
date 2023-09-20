<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    #[Route('/post', name: 'app_post')]
    public function index(
        PostRepository $postRepository,
        Request $request
        ): Response
    {
        
        return $this->render('pages/post/index.html.twig', [
            'posts' => $postRepository->findPublished($request->query->getInt('page',1)),
        ]);
    }

    #[Route('/article/{slug}', name: 'post.show', methods: ['GET'])]
    public function show(Post $post): Response
    {
       
        return $this->render('pages/blog/show.html.twig',[
            'post' => $post
        ]);
        
        

    }
}
