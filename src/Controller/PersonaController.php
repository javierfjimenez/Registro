<?php

namespace App\Controller;

use App\Entity\Persona;
use App\Entity\Task;
use App\Entity\User;
use App\Form\PersonaType;
use App\Form\TaskType;
use App\Repository\PersonaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;


class PersonaController extends AbstractController
{
    /**
     * @Route("/persona", name="persona", methods={"GET","POST"})
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $personaRepository = $this->getDoctrine()->getRepository(Persona::class);
        $personas = $personaRepository->findBy([],['id' => 'DESC' ]);


        return $this->render('persona/index.html.twig', [
            'controller_name' => 'PersonaController',
            'personas' => $personas,
        ]);
    }

    /**
     * @Route("persona/new", name="persona_new", methods={"GET","POST"})
     */

    public function new(Request $request): Response
    {
        $persona = new Persona();
        $form = $this->createForm(PersonaType::class, $persona);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $persona->setUser($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($persona);
            $em->flush();

            return $this->redirect($this->generateUrl('task_detail', ['id' => $persona->getId()]));

        }
        return $this->render('persona/new.html.twig', array(
            'form' => $form->createView()

        ));
    }

    /**
     * @Route("/{id}", name="persona_show", methods={"GET"})
     */
    public function show(Persona $persona): Response
    {
        return $this->render('persona/show.html.twig', [
            'persona' => $persona,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="persona_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Persona $persona): Response
    {
        $form = $this->createForm(PersonaType::class, $persona);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('persona_index', [
                'id' => $persona->getId(),
            ]);
        }

        return $this->render('persona/edit.html.twig', [
            'persona' => $persona,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="persona_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Persona $persona): Response
    {
        if ($this->isCsrfTokenValid('delete'.$persona->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($persona);
            $entityManager->flush();
        }

        return $this->redirectToRoute('persona_index');
    }
}
