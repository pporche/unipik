<?php

namespace Tests\Unipik\ArchitectureBundle\Controller;

use Unipik\ArchitectureBundle\Controller\InterventionController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class volunteerTest extends WebTestCase {

    public function testLinkFromIndex() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/unicef/accueil');

        $link = $crawler->filter('.navbar+div a[href*="/unicef/benevole/accueil"]')->eq(0)->link();

        $crawler = $client->click($link);

        $this->assertContains(
            'Liste des bénévoles',
            $client->getResponse()->getContent()
        );

    }

    public function testLinkFromNavbar() {
        $client = static::createClient();


        $crawler = $client->request('GET', '/unicef/accueil');
        $link = $crawler->filter('.navbar a[href*="/unicef/benevole/accueil"]')->eq(0)->link();
        $crawler = $client->click($link);

        $this->assertContains(
            'Liste des bénévoles',
            $client->getResponse()->getContent()
        );


        $crawler = $client->request('GET', '/unicef/accueil');
        $link = $crawler->filter('.navbar a[href*="/unicef/benevole/ajouter"]')->eq(0)->link();
        $crawler = $client->click($link);


        $this->assertContains(
            'Prenom',
            $client->getResponse()->getContent()
        );

    }

    public function testLinkFromVolunteerIndex() {
        $client = static::createClient();


        $crawler = $client->request('GET', '/unicef/benevole/accueil');
        $link = $crawler->filter('table a[href*="/unicef/benevole/ajouter"]')->eq(0)->link();
        $crawler = $client->click($link);

        $this->assertContains(
            'Prenom',
            $client->getResponse()->getContent()
        );

    }



    public function testForm() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/unicef/benevole/ajouter');

        $this->assertContains(
            'Prenom',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Prenom',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Tel fixe',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Tel portable',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Email',
            $client->getResponse()->getContent()
        );


    }

    public function testListe() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/unicef/benevole/accueil');

        $this->assertContains(
            'Nom',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Prenom',
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


        $crawler = $client->request('GET', '/unicef/benevole/ajouter');
        $form = $crawler->selectButton('volunteer_save')->form();
        $form['volunteer[prenom]'] = 'Toto';
        $form['volunteer[nom]'] = 'Legrand';
        $form['volunteer[telFixe]'] = '0200000000';
        $form['volunteer[telPortable]'] = '0600000000';
        $form['volunteer[email]'] = 'toto.legrand@trucbidouille.com';
        $crawler = $client->submit($form);

        $this->assertTrue($client->getResponse()->isRedirect());
        $crawler = $client->followRedirect();

        $this->assertContains(
            'Félicitation',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Bénévole bien enregistré.',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Legrand',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Toto',
            $client->getResponse()->getContent()
        );



        $link = $crawler->filter('.navbar+div a[href*="/unicef/benevole/details"]')->last()->link();
        $crawler = $client->click($link);

        $this->assertContains(
            'Legrand',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Toto',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'toto.legrand@trucbidouille.com',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            '0200000000',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            '0600000000',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Nom',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Prenom',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Email',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Téléphone Fixe',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Téléphone Portable',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Supprimer le bénévole',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'retour à l\'accueil',
            $client->getResponse()->getContent()
        );



        $link = $crawler->filter('table a[href*="/unicef/benevole/accueil"]')->last()->link();
        $crawler = $client->click($link);
        $link = $crawler->filter('.navbar+div a[href*="/unicef/benevole/supprimer"]')->last()->link();
        $crawler = $client->click($link);
        $this->assertTrue($client->getResponse()->isRedirect());
        $crawler = $client->followRedirect();

        $this->assertContains(
            'Félicitation',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Bénévole bien supprimé',
            $client->getResponse()->getContent()
        );

        $this->assertNotContains(
            'Toto',
            $client->getResponse()->getContent()
        );

    }

}
