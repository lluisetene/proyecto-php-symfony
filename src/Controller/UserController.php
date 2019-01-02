<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\RegisterType;
use Symfony\Component\HttpFoundation\Respose;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class UserController extends AbstractController
{
    // Se puede hacer esto o añadir la ruta al fichero routes.yaml
 //   /**
 //    * @Route("/user", name="user")
 //    */
    public function register(Request $request, UserPasswordEncoderInterface $encoder)
    {
        // Crear formulario
        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);

        // Rellenar el objeto con los datos del formulario
        $form->handleRequest($request);

        // Comprobar si el formulario ha enviado los datos
        if($form->isSubmitted() && $form->isValid()) {

            // Modificando el objeto para guardarlo
            $user->setRole('ROLE_USER');
            $user->setCreateAt(new \DateTime('now'));

            // Cifrando la contraseña
            $encoder = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($encoder);

            // Guardar usuario
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('tasks');
        }


        return $this->render('user/register.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function login(AuthenticationUtils $authenticationUtils) {
        $error = $authenticationUtils->getLastAuthenticationError();

        // Último usuario que ha intendao loguear y que ha fallado
        $lastUserName = $authenticationUtils->getLastUsername();


        return $this->render('user/login.html.twig', array(
            'error' => $error,
            'last_username' => $lastUserName
        ));
    }
}
