<?php

namespace App\Controller\Admin;

use App\Entity\Admin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * @Route("/admin")
 */
class AdminSecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_admin_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/admin_login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="admin_app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
     * @Route("/register", name="admin_register")
     */
    public function register(UserPasswordEncoderInterface $encoder)
    {
        // $admin = new Admin();
        // $admin->setRoles(['ROLE_ADMIN']);
        // $admin->setEmail('yamking01@gmail.com');
        // $admin->setPassword($encoder->encodePassword($admin,"12345678"));
        // $em = $this->getDoctrine()->getManager();
        // $em->persist($admin);
        // $em->flush();
        dd('collo');
        # code...
    }

}
