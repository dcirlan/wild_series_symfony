<?php

namespace App\Controller;

use App\Entity\Actor;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ActorController extends AbstractController
{
    /**
     * @Route("/actor", name="actor")
     */
    public function index(): Response
    {
        return $this->render('actor/index.html.twig', [
            'controller_name' => 'ActorController',
        ]);
    }

    /**
     * @Route("/actor/{id}", name="actor_show", methods={"GET"})
     */
    public function show(Actor $actor): Response
    {
        return $this->render('episode/show.html.twig', [
            'actor' => $actor,
        ]);
    }

}
