<?php

namespace App\Controller;

use App\Entity\Dirigente;
use App\Form\DirigenteType;
use App\Repository\DirigenteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * @Route("/")
 */
class DirigenteController extends AbstractController
{
    /**
     * @Route("dirigente/", name="dirigente_index", methods={"GET"})
     */
    public function index(DirigenteRepository $dirigenteRepository): Response
    {
        return $this->render('dirigente/index.html.twig', [
            'dirigentes' => $dirigenteRepository->findAll(),
        ]);
    }
    public function login (AuthenticationUtils $authenticationUtils){
        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUser = $authenticationUtils->getLastUsername();

        return $this->render('user/login.html.twig',array(
            'error'     => $error,
            'lastUser'  => $lastUser
        ));

    }

    /**
     * @Route("dirigente/new", name="dirigente_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $dirigente = new Dirigente();
        $form = $this->createForm(DirigenteType::class, $dirigente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($dirigente);
            $entityManager->flush();

            return $this->redirectToRoute('dirigente_index');
        }

        return $this->render('dirigente/new.html.twig', [
            'dirigente' => $dirigente,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("dirigente/{id}", name="dirigente_show", methods={"GET"})
     */
    public function show(Dirigente $dirigente): Response
    {
        return $this->render('dirigente/show.html.twig', [
            'dirigente' => $dirigente,
        ]);
    }

    /**
     * @Route("dirigente/{id}/edit", name="dirigente_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Dirigente $dirigente): Response
    {
        $form = $this->createForm(DirigenteType::class, $dirigente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('dirigente_index', [
                'id' => $dirigente->getId(),
            ]);
        }

        return $this->render('dirigente/edit.html.twig', [
            'dirigente' => $dirigente,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("dirigente/{id}", name="dirigente_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Dirigente $dirigente): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dirigente->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($dirigente);
            $entityManager->flush();
        }

        return $this->redirectToRoute('dirigente_index');
    }
}
