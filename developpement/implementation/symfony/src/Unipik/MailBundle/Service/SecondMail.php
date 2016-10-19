<?php

namespace Unipik\MailBundle\Service;

/**
 * Created by PhpStorm.
 * User: scolomies
 * Date: 12/10/16
 * Time: 14:06
 */
class SecondMail {
    protected $mailer;

    public function __construct($mailer) {
        $this->mailer = $mailer;
    }

    public function send($message) {
        $this->mailer->send($message);
    }
}