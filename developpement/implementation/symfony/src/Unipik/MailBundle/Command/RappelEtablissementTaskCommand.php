<?php
/**
 * Created by PhpStorm.
 * User: scolomies
 * Date: 21/11/16
 * Time: 13:14
 */

namespace Unipik\MailBundle\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RappelEtablissementTaskCommand extends ContainerAwareCommand {
    private $output;

    /**
     * Configurer les options
     *
     * @return void
     */
    protected function configure() {
        $this
            ->setName('mailEtablissementRappelTask:run')
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
        $etablissements = $em->getRepository('InterventionBundle:Etablissement')->getEmailEtablissementRappel();

        if (empty($etablissements)) {
            $output->writeln('<comment>pas d\'interventions prévues dans une semaine</comment>');
            exit();
        } else {
            foreach ($etablissements as $id) {
                $emails = $em->getRepository('InterventionBundle:Etablissement')->find($id)->getEmails();
                $interventions = $em->getRepository('InterventionBundle:Intervention')->getInterventionByEtablissementIdRappel($id);
                $message = \Swift_Message::newInstance()
                    ->setSubject('Rappel intervention de l\'unicef')
                    ->setFrom('unipik.dev@gmail.com')
                    //->setTo($emails)
                    ->setTo('dev1@yopmail.com')
                    ->setBody(
                        $this
                            ->getContainer()
                            ->get('templating')
                            ->render(
                                'MailBundle:mailsRappel:rappelEtablissement.html.twig',
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