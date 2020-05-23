<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
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
     * @Route("/dev/new", name="dev_create")
     */
    public function create(Request $request, EntityManagerInterface $entityManager)
    {
        if ($request->request->count() > 0) {
            $article = new Article();
            $article->setTitle($request->request->get('title'))
                    ->setContent($request->request->get('content'))
                    ->setImage($request->request->get('image'))
                    ->setCreatedAt(new \DateTime());

            $entityManager->persist($article);
            $entityManager->flush();
        }

        return $this->render('dev/create.html.twig');
    }

    /**
     * @Route("/dev/{id}", name="dev_show")
     */
    public function show(Article $article)
    {
        return $this->render('dev/show.html.twig', [
            'article' => $article
        ]);
    }
}
