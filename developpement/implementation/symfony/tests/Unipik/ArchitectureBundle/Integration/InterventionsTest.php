<?php

namespace Tests\Unipik\ArchitectureBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class interventionTest extends WebTestCase {

    public function testLinkFromIndex() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/unicef/accueil');

        $link = $crawler->filter('.navbar+div a[href*="/unicef/intervention/accueil"]')->eq(0)->link();

        $crawler = $client->click($link);

        $this->assertContains(
            'Liste des interventions',
            $client->getResponse()->getContent()
        );

    }

    public function testLinkFromNavbar() {
        $client = static::createClient();


        $crawler = $client->request('GET', '/unicef/accueil');
        $link = $crawler->filter('.navbar a[href*="/unicef/intervention/accueil"]')->eq(0)->link();
        $crawler = $client->click($link);

        $this->assertContains(
            'Liste des interventions',
            $client->getResponse()->getContent()
        );


        $crawler = $client->request('GET', '/unicef/accueil');
        $link = $crawler->filter('.navbar a[href*="/unicef/intervention/ajouter"]')->eq(0)->link();
        $crawler = $client->click($link);


        $this->assertContains(
            'Lieu',
            $client->getResponse()->getContent()
        );

    }

    public function testLinkFromInterventionIndex() {
        $client = static::createClient();


        $crawler = $client->request('GET', '/unicef/intervention/accueil');
        $link = $crawler->filter('table a[href*="/unicef/intervention/ajouter"]')->eq(0)->link();
        $crawler = $client->click($link);

        $this->assertContains(
            'Materiel dispo',
            $client->getResponse()->getContent()
        );

    }



    public function testForm() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/unicef/intervention/ajouter');

        $this->assertContains(
            'Materiel dispo',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Remarques',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Lieu',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Nb personnes',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Moment',
            $client->getResponse()->getContent()
        );


    }

    public function testListe() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/unicef/intervention/accueil');

        $this->assertContains(
            'Lieu',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Date',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Voir détails',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Supprimer',
            $client->getResponse()->getContent()
        );

    }

    public function testAddViewDelete() {
        $client = static::createClient();


        $crawler = $client->request('GET', '/unicef/intervention/ajouter');
        $form = $crawler->selectButton('intervention_save')->form();
        $form['intervention[materielDispo]'] = 'Que dalle!';
        $form['intervention[remarques]'] = 'Une remarque pertinante.';
        $form['intervention[lieu]'] = 'Nulle part';
        $form['intervention[nbPersonnes]'] = '75';
        $form['intervention[moment]'] = 'jamais';
        $crawler = $client->submit($form);

        $this->assertTrue($client->getResponse()->isRedirect());
        $crawler = $client->followRedirect();

        $this->assertContains(
            'Félicitation',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Intervention bien enregistrée.',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Nulle part',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'jamais',
            $client->getResponse()->getContent()
        );



        $link = $crawler->filter('.navbar+div a[href*="/unicef/intervention/details"]')->last()->link();
        $crawler = $client->click($link);

        $this->assertContains(
            'Nulle part',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'jamais',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            '75',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Que dalle!',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Une remarque pertinante',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Lieu',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Date',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Nombre de personnes',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Matériel disponible',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Remarques',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Supprimer l\'intervention',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'retour à l\'accueil',
            $client->getResponse()->getContent()
        );



        $link = $crawler->filter('table a[href*="/unicef/intervention/accueil"]')->last()->link();
        $crawler = $client->click($link);
        $link = $crawler->filter('.navbar+div a[href*="/unicef/intervention/supprimer"]')->last()->link();
        $crawler = $client->click($link);
        $this->assertTrue($client->getResponse()->isRedirect());
        $crawler = $client->followRedirect();

        $this->assertContains(
            'Félicitation',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Intervention bien supprimé',
            $client->getResponse()->getContent()
        );

        $this->assertNotContains(
            'Nulle part',
            $client->getResponse()->getContent()
        );

    }

}
