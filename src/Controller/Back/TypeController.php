<?php

namespace App\Controller\Back;

use App\Entity\Type;
use App\Form\TypeType;
use App\Repository\TypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/type')]
class TypeController extends AbstractController
{
    #[Route('/', name: 'type_index', methods: ['GET'])]
    public function index(TypeRepository $typeRepository): Response
    {
        return $this->render('Back/type/index.html.twig', [
            'types' => $typeRepository->findBy([], ['position' => 'ASC']),
        ]);
    }

    #[Route('/{id}/{sortable}', name: 'type_sortable', requirements: ['id' => '\d+', 'sortable' => 'UP|DOWN'], methods: ['GET'])]
    public function sortable(Type $type /* ParamConverter */, string $sortable, EntityManagerInterface $manager): Response
    {
        $move = $sortable === 'UP' ? -1 : 1;
        $type->setPosition($type->getPosition() + $move);
        $manager->flush();
        return $this->redirectToRoute('type_index');
    }

    #[Route('/new', name: 'type_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TypeRepository $typeRepository): Response
    {
        $type = new Type();
        $form = $this->createForm(TypeType::class, $type);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $typeRepository->save($type, true);

            return $this->redirectToRoute('back_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Back/type/new.html.twig', [
            'type' => $type,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'type_show', methods: ['GET'])]
    public function show(Type $type): Response
    {
        return $this->render('Back/type/show.html.twig', [
            'type' => $type,
        ]);
    }

    #[Route('/{id}/edit', name: 'type_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Type $type, TypeRepository $typeRepository): Response
    {
        $form = $this->createForm(TypeType::class, $type);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $typeRepository->save($type, true);

            return $this->redirectToRoute('back_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Back/type/edit.html.twig', [
            'type' => $type,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'type_delete', methods: ['POST'])]
    public function delete(Request $request, Type $type, TypeRepository $typeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $type->getId(), $request->request->get('_token'))) {
            $typeRepository->remove($type, true);
        }

        return $this->redirectToRoute('back_type_index', [], Response::HTTP_SEE_OTHER);
    }
}
