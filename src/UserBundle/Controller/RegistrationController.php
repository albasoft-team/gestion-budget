<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace UserBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use UserBundle\Entity\User;

/**
 * Controller managing the registration.
 *
 * @author Thibault Duplessis <thibault.duplessis@gmail.com>
 * @author Christophe Coevoet <stof@notk.org>
 */
class RegistrationController extends  BaseController
{
    public function confirmedAction()
    {
        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();

        return $this->render('@FOSUser/Registration/confirmed.html.twig', array(
            'users' => $users,
        ));
    }

//    /**
//     * Deletes a user entity.
//     *
//     * @Route("/{id}", name="user_delete")
//     * @Method("DELETE")
//     */
//    public function deleteAction(Request $request, User $user)
//    {
//        $form = $this->createDeleteForm($user);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->remove($user);
//            $em->flush();
//        }
//
//        return $this->redirectToRoute('fos_user_registration_confirm');
//    }

}
