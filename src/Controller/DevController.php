<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Repository\ArticleRepository;

class DevController extends AbstractController
{
    /**
     * @Route("/dev", name="dev")
     */
    public function index(ArticleRepository $repo)
    {
        $articles = $repo->findAll();

        return $this->render('dev/index.html.twig', [
            'controller_name' => 'DevController',
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('dev/home.html.twig', [
            'titre' => "Bienvenue ici les amies !",
            'age' => 31
        ]);
    }

    /**
     * @Route("/dev/{id}", name="dev_show")
     */
    public function show(ArticleRepository $repo, $id)
    {
        $article = $repo->find($id);
   
        return $this->render('dev/show.html.twig', [
            'article' => $article
        ]);
    }
}
