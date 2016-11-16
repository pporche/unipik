<?php
/**
 * Created by PhpStorm.
 * User: florian
 * Date: 19/04/16
 * Time: 11:59
 *
 * PHP version 5
 *
 * @category None
 * @package  MailBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */

namespace Unipik\MailBundle\Service;

/**
 * Class SecondMail
 *
 * @category None
 * @package  MailBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class SecondMail {
    protected $mailer;

    /**
     * SecondMail constructor.
     *
     * @param mailer $mailer Le mailer
     */
    public function __construct($mailer) {
        $this->mailer = $mailer;
    }

    /**
     * Envoyer
     *
     * @param string $message Le message
     *
     * @return void
     */
    public function send($message) {
        $this->mailer->send($message);
    }
}