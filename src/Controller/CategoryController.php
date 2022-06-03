<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;

class CategoryController extends AbstractController
{
    #[Route('/category', name: 'app_category')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categorys = $categoryRepository->findAll();
        return $this->render('category/index.html.twig', [
            'categorys'=> $categorys,
        ]);
    }
    #[Route('/show_category/{id}', name: 'app_category_show')]
    public function show_category($id, CategoryRepository $categoryRepository): Response
    {
        
        $categorys = $categoryRepository->find($id);
        // dd($categorys);
        
        //si l'article est nul on rentre dans la conditions
        if (!$categorys )
        {
            return $this->redirectToRoute('app_category');
        }
        return $this->render('show_category/index.html.twig',[
            'categorys'=> $categorys,
        ]);
    }

}
