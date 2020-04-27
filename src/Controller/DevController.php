<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DevController extends AbstractController
{
    /**
     * @Route("/dev", name="dev")
     */
    public function index()
    {
        return $this->render('dev/index.html.twig', [
            'controller_name' => 'DevController',
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
}
