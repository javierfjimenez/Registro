<?php

namespace App\Controller;

use App\Entity\Persona;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PersonaController extends AbstractController
{
    /**
     * @Route("/persona", name="persona")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();

        $persona_repo = $this->getDoctrine()->getRepository(User::class);
        $users = $persona_repo->findAll();

        foreach ($users as $user) {
            echo $user->getName();

            //var_dump($users->getPersonas());
            //die();
            foreach ($user->getPersonas() as $persona) {
                echo $persona->getName();
            }
        }

        return $this->render('persona/index.html.twig', [
            'controller_name' => 'PersonaController',
        ]);
    }
}
