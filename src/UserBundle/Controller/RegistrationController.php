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

}
