<?php

namespace App\Controller;

use App\Entity\Persona;
use App\Entity\User;
use App\Form\PersonaType;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
        $persona_repo = $this->getDoctrine()->getRepository(Persona::class);
        $personas = $persona_repo->findBy([], ['id' => 'DESC']);

        return $this->render('persona/index.html.twig', [
            'controller_name' => 'PersonaController',
            'personas' => $personas
        ]);
    }

    /**
     *
     * @Route("persona/detail/{id}", name="persona_detail"))
     */
    public function details(Persona $persona)
    {
        if (!$persona) {

            return $this->redirectToRoute('persona');
        } else {

            return $this->render('persona/detail.html.twig', [
                'persona' => $persona
            ]);
        }
    }

    /**
     * @Route("persona/new", name="persona_new", methods={"GET","POST"})
     */
    public function createPersona(Request $request)
    {
        $persona = new Persona();
        $form = $this->createForm(PersonaType::class, $persona);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $persona->setUser($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($persona);
            $em->flush();

            return $this->redirect($this->generateUrl('persona_detail', ['id' => $persona->getId()]));
        }
        return $this->render('persona/create.html.twig', array(
            'form' => $form->createView()

        ));
    }

    /**
     * @Route("/my/persona",name="my_persona")
     */
    public function mypersonas(UserInterface $user)
    {
        $persona = $user->getPersonas();

        return $this->render('persona/my_persona.html.twig', array(
            'persona' => $persona
        ));
    }

    /**
     *
     * @Route("persona/edit/{id}",name="persona_edit")
     */
    public function edit(Request $request, UserInterface $user, Persona $persona)
    {

        if (!$user || $user->getId() != $persona->getUser()->getId()) {

            return $this->redirectToRoute('persona');
        }
        $form = $this->createForm(PersonaType::class, $persona);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($persona);
            $em->flush();

            return $this->redirect($this->generateUrl('persona_detail', ['id' => $persona->getId()]));

        }
        return $this->render('persona/create.html.twig', array(
            'form' => $form->createView()

        ));

        return $this->render('persona/create.html.twig', array(
            'edit' => true,
            'form' => $form->createView()
        ));
    }

    /**
     *
     * @Route("persona/delete/{id}",name="persona_delete")
     */
    public function delete(Persona $persona, UserInterface $user)
    {
        if (!$user || $user->getId() != $persona->getUser()->getId()) {

            return $this->redirectToRoute('persona');
        }
        if (!$persona) {

            return $this->redirectToRoute('persona');
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($persona);
        $em->flush();

        return $this->redirectToRoute('persona');

    }


}
