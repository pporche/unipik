<?php

namespace Unipik\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class UserBundle
 * 
 * @package Unipik\UserBundle
 */
class UserBundle extends Bundle {
    public function getParent() {
        return 'FOSUserBundle';
    }
}
