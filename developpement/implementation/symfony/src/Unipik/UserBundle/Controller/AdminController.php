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

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;


/**
 * Controller pour l'admin
 *
 * @category None
 * @package  UserBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class AdminController extends UserController {

    /**
     * Add a privilege action
     *
     * @return object
     */
    public function addPrivilegeAction() {

    }

    /**
     * Delete a privilege action
     *
     * @return object
     */
    public function deletePrivilegeAction() {

    }

    /**
     * Create a privilege action
     *
     * @return object
     */
    public function createPrivilegeAction() {

    }

    /**
     * Delete a account action
     *
     * @return object
     */
    public function deleteAccountAction() {

    }

    public function verifyBenevoleAction(Request $request) {
        if ($request->isXmlHttpRequest()) {
            $benevoleUsername = $request->get('username');

            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('UserBundle:Benevole');

            $benevole = $repository->findOneBy(array('username' => $benevoleUsername));

            if ($benevole) {
                return new JsonResponse(array('result' => true));
            } else {
                return new JsonResponse(array('result' => false));
            }

        }
        return new Response();
    }
}
