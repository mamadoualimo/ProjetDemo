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
        $article = new Article();

        $form = $this->createFormBuilder($article)
                     ->add('title', TextType::class, [
                         'attr' => [
                             'placeholder' => "Titre de l'article"
                         ]
                     ])
                     ->add('content', TextareaType::class, [
                        'attr' => [
                            'placeholder' => "Contenu de l'article"
                        ]
                     ])
                     ->add('image', TextType::class, [
                        'attr' => [
                            'placeholder' => "image de l'article"
                        ]
                     ])
                     ->getForm();
                        

        return $this->render('dev/create.html.twig', [
            'formArticle' => $form->createView()
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
