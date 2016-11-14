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

namespace Unipik\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class UserBundle
 *
 * @category None
* @package  UserBundle
* @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
* @link     None
*/
class UserBundle extends Bundle {

    /**
     * Renvoie le parent
     *
     * @return string
     */
    public function getParent() {
        return 'FOSUserBundle';
    }
}
