<?php
/**
 * Created by PhpStorm.
 * User: scolomies
 * Date: 08/11/16
 * Time: 10:01
 */

namespace Unipik\MailBundle\Controller;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Unipik\MailBundle\Entity\CronTask;
use Symfony\Component\HttpFoundation\Response;
use Unipik\MailBundle\Entity\MailTask;

class CronTaskController extends Controller {
    public function mailTaskAction() {
        $entity = new MailTask();

        $id = array();
        for($i=1; $i<=40; $i++) {
            array_push($id, $i);
        }

        $entity
            ->setName('Mail task')
            ->setInterval(300)
            ->setDateInsert(new \DateTime())
            ->setIdEtablissement($id)
        ;

        $em = $this->getDoctrine()->getManager();
        $em->persist($entity);
        $em->flush();

        return new Response('OK!');
    }

    public function ToastAction() {
        $em = $this->getDoctrine()->getManager();
        $mailTask = $em->getRepository('MailBundle:MailTask')->findOneBy(array('id' => 81));
        var_dump($mailTask->getIdEtablissement());
        return new Response('OK!');
    }
}