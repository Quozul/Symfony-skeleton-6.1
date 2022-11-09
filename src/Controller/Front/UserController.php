<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/user', name: 'user_')]
class UserController extends AbstractController
{
    #[Route(path: '/pokemon', name: 'pokemon_list')]
    public function pokemon(): Response
    {

        return $this->render('security/login.html.twig', [
            'pokemonList' =>$this->getUser()->getPokemons()
        ]);
    }
}
