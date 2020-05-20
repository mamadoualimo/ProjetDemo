<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;

class DevController extends AbstractController
{
    /**
     * @Route("/dev", name="dev")
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(Article::class);

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
    public function show($id)
    {
        $repo = $this->getDoctrine()->getRepository(Article::class);

        $article = $repo->find($id);
   
        return $this->render('dev/show.html.twig', [
            'article' => $article
        ]);
    }
}
