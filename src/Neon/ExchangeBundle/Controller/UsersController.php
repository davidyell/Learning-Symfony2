<?php
namespace Neon\ExchangeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\SecurityContextInterface;

use Neon\ExchangeBundle\Form\Type\LoginType;

/**
 * UsersController
 *
 * @author David Yell <neon1024@gmail.com>
 */
class UsersController extends Controller {
	
    /**
     * Log a user into the site
     *
     * @Route("/login", name="login")
     * @Template()
     *
     * @return array
     */
	public function loginAction(Request $request) {
        $session = $request->getSession();
		
        // get the login error if there is one
        if ($request->attributes->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContextInterface::AUTHENTICATION_ERROR
            );
        } elseif (null !== $session && $session->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
            $session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);
        } else {
            $error = '';
        }
		
		$form = $this->createForm(new LoginType());
		
		return [
			'last_username' => $session->get(SecurityContextInterface::LAST_USERNAME),
			'error' => $error,
			'form' => $form->createView()
		];
	}
	
}