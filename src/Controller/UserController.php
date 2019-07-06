<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends AbstractController
{
    /**
     * @Route("user/new", name="user_new", methods={"GET"})
     */
    public function register(Request $request, UserPasswordEncoderInterface $encoder)
    {
        //Creando el Formulario
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        //Rellernar el Objeto con los Datos del Formulario
        $form->handleRequest($request);

        //Verificando si los Datos fueron fueron enviados
        if ($form->isSubmitted() && $form->isValid()) {

            //Modificando el objeto para guardarlo
            $user->setRole('ROLE_USER');
            $encoded = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($encoded);

            //Guardar Usuario
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('persona');
        }

        return $this->render('user/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function login(AuthenticationUtils $authenticationUtils)
    {
        //Consegir el error si se produce al logear usuario
        $error = $authenticationUtils->getLastAuthenticationError();
        //Conseguir el ultimo usuario logeado
        $lastUserName = $authenticationUtils->getLastUsername();


        return $this->render('user/login.html.twig', array(
            'error' => $error,
            'lastUser' => $lastUserName
        ));
    }
}