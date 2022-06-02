<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleRepository;

class AccueilController extends AbstractController
{
    #[Route('/accueil', name: 'app_accueil')]
    public function index(ArticleRepository $articleRepository): Response
    {
        $articles = $articleRepository->findAll();
        // dd($articles);
        return $this->render('accueil/index.html.twig',[
            'articles'=> $articles,
        ]);
    }
    #[Route('/show/{id}', name: 'app_show')]
    public function show($id, ArticleRepository $articleRepository): Response
    {
        $articles = $articleRepository->find($id);
        //si l'article est nul on rentre dans la conditions
        if (!$articles )
        {
            return $this->redirectToRoute('app_accueil');
        }
        return $this->render('show/index.html.twig',[
            'articles'=> $articles,
        ]);
    }
}   