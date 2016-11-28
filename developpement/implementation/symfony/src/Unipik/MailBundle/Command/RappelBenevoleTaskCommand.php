<?php
/**
 * Created by PhpStorm.
 * User: scolomies
 * Date: 21/11/16
 * Time: 09:38
 *
 * PHP version 5
 *
 * @category None
 * @package  MailBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */

namespace Unipik\MailBundle\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

//sudo php bin/console mailBenevoleRappelTask:run
/**
 * Class MailTaskCommand
 *
 * @category None
 * @package  MailBundle
 * @author   Unipik <unipik.unicef@laposte.com>
 * @license  None None
 * @link     None
 */
class RappelBenevoleTaskCommand extends ContainerAwareCommand {
    private $output;

    /**
     * Configurer les options
     *
     * @return void
     */
    protected function configure() {
        $this
            ->setName('mailBenevoleRappelTask:run')
            ->setDescription('Cron task for delayed mailing');
    }

    /**
     * Executer
     *
     * @param InputInterface  $input  L'entree
     * @param OutputInterface $output La sortie
     *
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output) {
        $this->output = $output;

        $em = $this->getContainer()->get('doctrine')->getManager();
        $benevolesEmails = $em->getRepository('UserBundle:Benevole')->getEmailBenevoleRappel();

        if (empty($benevolesEmails)) {
            $output->writeln('<comment>pas d\'interventions prévues dans une semaine</comment>');
            exit();
        } else {
            foreach ($benevolesEmails as $email) {
                $interventions = $em->getRepository('InterventionBundle:Intervention')->getInterventionByBenevoleEmailRappel($email);
                $message = \Swift_Message::newInstance()
                    ->setSubject('Rappel intervention de l\'unicef')
                    ->setFrom('unipik.dev@gmail.com')
                    //->setTo($email)
                    ->setTo('dev1@yopmail.com')
                    ->setBody(
                        $this
                            ->getContainer()
                            ->get('templating')
                            ->render(
                                'MailBundle:mailsRappel:rappelBenevole.html.twig',
                                array('interventions' => $interventions)
                            ),
                        'text/html'
                    );
                $this
                    ->getContainer()
                    ->get('mailer')
                    ->send($message);
            }
        }

        $output->writeln('<comment>Done!</comment>');
    }

}