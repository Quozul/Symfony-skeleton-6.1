<?php

namespace App\Controller\Back;

use App\Entity\Pokemon;
use App\Form\PokemonType;
use App\Repository\PokemonRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PokemonController extends AbstractController
{
    #[Route('/pokemon', name: 'pokemon')]
    public function index(PokemonRepository $repository): Response
    {
        return $this->render('Back/pokemon/index.html.twig', [
            'pokemons' => $repository->findAll(),
        ]);
    }

    #[Route('/pokemon/create', name: 'create_pokemon')]
    public function create(Request $request, PokemonRepository $repository): Response
    {
        $pokemon = new Pokemon();
        $form = $this->createForm(PokemonType::class, $pokemon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repository->save($pokemon, true);
            return $this->redirectToRoute('back_show_pokemon', ['id' => $pokemon->getId()]);
        }

        return $this->render('Back/pokemon/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/pokemon/{id}/edit', name: 'edit_pokemon', requirements: ['id' => '\d+'])]
    public function edit(Request $request, Pokemon $pokemon, ManagerRegistry $registry): Response
    {
        $form = $this->createForm(PokemonType::class, $pokemon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $registry->getManager()->flush(); // Can use $repository->save() here as well
            return $this->redirectToRoute('back_show_pokemon', ['id' => $pokemon->getId()]);
        }

        return $this->render('Back/pokemon/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/pokemon/{id}/delete/{token}', name: 'delete_pokemon', requirements: ['id' => '\d+'])]
    public function delete(Pokemon $pokemon, string $token, PokemonRepository $repository): Response
    {
        if (!$this->isCsrfTokenValid('remove' . $pokemon->getId(), $token)) {
            throw $this->createAccessDeniedException();
        }
        $repository->remove($pokemon, true);
        return $this->redirectToRoute('back_pokemon');
    }

    #[Route('/pokemon/{id}', name: 'show_pokemon', requirements: ['id' => '\d+'])]
    public function show(Pokemon $pokemon): Response
    {
        return $this->render('Back/pokemon/show.html.twig', [
            'pokemon' => $pokemon,
        ]);
    }
}
