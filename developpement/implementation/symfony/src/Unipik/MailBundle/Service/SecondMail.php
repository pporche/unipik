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
//        $message = \Swift_Message::newInstance()
//            ->setSubject('Hello Email')
//            ->setFrom('florian.leriche@neuf.fr')
//            ->setTo('onch@yopmail.com')
//            ->setBody('AAAAAAA')
//        ;
        $this->mailer->send($message);
    }
}