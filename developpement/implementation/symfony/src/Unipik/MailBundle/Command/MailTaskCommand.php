<?php
/**
 * Created by PhpStorm.
 * User: scolomies
 * Date: 09/11/16
 * Time: 10:43
 */

namespace Unipik\MailBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MailTaskCommand extends ContainerAwareCommand {
    private $output;
    private $limitEmails = 4;

    protected function configure() {
        $this
            ->setName('mailInstituteTask:run')
            ->setDescription('Cron task for delayed mailing');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $this->output = $output;

        $em = $this->getContainer()->get('doctrine')->getManager();
        $mailTask = $em->getRepository('MailBundle:MailTask')->getLastMailTask();

        if (is_null($mailTask)) {
            $output->writeln('<comment>No mailing task to run in database !</comment>');
            exit();
        }

        // On récupère la date de dernière execution et on calcul la prochaine date
        $lastrun = $mailTask->getLastRun() ? $mailTask->getLastRun()->format('U') : 0;
        $nextrun = $lastrun + $mailTask->getInterval();
        $run = (time() >= $nextrun);

        // Récup des établissement
        $idEtablissement = array();
        foreach ($mailTask->getIdEtablissement() as $id) {
            array_push($idEtablissement, $id);
        }
        $repository = $em->getRepository('InterventionBundle:Etablissement');
        $etablissements = $repository->findBy(array('id' => $idEtablissement));
        $etablissementsToPersist = array_splice($etablissements, $this->limitEmails);

        if ($run && isset($etablissements)) {
            $output->writeln(sprintf('Running Cron Task <info>%s</info>', $mailTask->getName()));

            // Set dernière date d'exécution de la crontask
            $mailTask->setLastRun(new \DateTime());

            foreach($etablissements as $etablissement) {
                $type = !empty($etablissement->getTypeEnseignement()) ? $etablissement->getTypeEnseignement() : $etablissement->getTypeCentre();
                $message = \Swift_Message::newInstance()
                    ->setSubject('Intervention de l\'unicef')
                    ->setFrom('unipik.dev@gmail.com')
                    //->setTo($institute->getEmails())
                    ->setTo('dev1@yopmail.com')
                    ->setBody(
                        $this
                            ->getContainer()
                            ->get('templating')
                            ->render(
                                'MailBundle:mailsEtablissement:email'.ucfirst($type).'.html.twig',
                                array('id' => $etablissement->getId())
                            ),
                        'text/html'
                    );
                $this
                    ->getContainer()
                    ->get('mailer')
                    ->send($message);
            }

            if (!empty($etablissementsToPersist)) {
                $idToPersist = array();
                foreach ($etablissementsToPersist as $etab) {
                    array_push($idToPersist, $etab->getid());
                }
                $mailTask->setIdEtablissement($idToPersist); //tache pas terminée, on met à jour la db
                $em->persist($mailTask);
            } else {
                $em->remove($mailTask); //si y'a plus du tout d'etablissements on supprime la tache car terminée
            }
        } else {
            $output->writeln(sprintf('Skipping Cron Task <info>%s</info>', $mailTask->getName()));
        }
        $output->writeln('<comment>Done!</comment>');
        $em->flush();
    }
}