<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Form\ArticleType;

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
     * @Route("/dev/{id}/edit", name="dev_edit")
     */
    public function form(Article $article = null, Request $request, EntityManagerInterface $entityManager)
    {
        if (!$article) {
            $article = new Article();
        }
        

        //$form = $this->createFormBuilder($article)
        //             ->add('title')
        //             ->add('content')
        //           ->add('image')
        //           ->getForm();

        $form = $this->createForm(ArticleType::class, $article);
                        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!$article->getId()) {
                $article->setCreatedAt(new \DateTime());
            }

            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('dev_show', ['id' => $article->getId()]);
        }

        return $this->render('dev/create.html.twig', [
            'formArticle' => $form->createView(),
            'editMode' => $article->getId() !== null
        ]);
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
