<?php
/**
 * Created by PhpStorm.
 * User: Kafui
 * Date: 13/09/16
 * Time: 11:55
 *
 * PHP version 5
 *
 * @category None
 * @package  UserBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */

namespace Unipik\UserBundle\Controller;

use FOS\UserBundle\Controller\SecurityController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\SecurityContext;
use Unipik\UserBundle\Form\LoginType;
use Unipik\UserBundle\Form\RegistrationType;

/**
 * Login/out actions
 *
 * @category None
 * @package  UserBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class SecurityController extends BaseController {

    /**
     * Render the login page
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function loginPageAction() {
        return $this->render('UserBundle:Security:loginPage.html.twig');
    }

    /**
     * Render the login page
     *
     * @param Request $request La requete
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function loginAction(Request $request) {
        return parent::loginAction($request);
    }

    /**
     * Render the login page
     *
     * @param array $data Les donnees
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function renderLogin(array $data) {
        $form = $this->createForm(LoginType::class, null,  array("action" => $this->generateUrl("fos_user_security_check")))
            ->createView();

        return $this->render(
            'UserBundle:Security:login.html.twig', array(
            'form' => $form,
            'error' => $data['error']
            )
        );
    }
}
