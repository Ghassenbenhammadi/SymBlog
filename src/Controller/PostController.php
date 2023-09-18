<?php

namespace App\Controller;

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
}
