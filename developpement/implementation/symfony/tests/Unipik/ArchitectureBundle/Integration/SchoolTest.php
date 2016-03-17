<?php
/**
 * Created by PhpStorm.
 * User: florian
 * Date: 17/03/16
 * Time: 10:35
 */

namespace Tests\Unipik\ArchitectureBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SchoolTest extends WebTestCase {

    public function testLinkFromIndex() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/unicef/accueil');

        $link = $crawler->filter('.navbar+div a[href*="/unicef/etablissement/accueil"]')->eq(0)->link();

        $crawler = $client->click($link);

        $this->assertContains(
            'Liste des établissements',
            $client->getResponse()->getContent()
        );

    }

    public function testLinkFromNavbar() {
        $client = static::createClient();


        $crawler = $client->request('GET', '/unicef/accueil');
        $link = $crawler->filter('.navbar a[href*="/unicef/etablissement/accueil"]')->eq(0)->link();
        $crawler = $client->click($link);

        $this->assertContains(
            'Liste des établissements',
            $client->getResponse()->getContent()
        );


        $crawler = $client->request('GET', '/unicef/accueil');
        $link = $crawler->filter('.navbar a[href*="/unicef/etablissement/ajouter"]')->eq(0)->link();
        $crawler = $client->click($link);


        $this->assertContains(
            'Ville',
            $client->getResponse()->getContent()
        );

    }

    public function testLinkFromSchoolIndex() {
        $client = static::createClient();


        $crawler = $client->request('GET', '/unicef/etablissement/accueil');
        $link = $crawler->filter('table a[href*="/unicef/etablissement/ajouter"]')->eq(0)->link();
        $crawler = $client->click($link);

        $this->assertContains(
            'Nom',
            $client->getResponse()->getContent()
        );

    }

    public function testForm() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/unicef/etablissement/ajouter');

        $this->assertContains(
            'Nom',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Nb eleve',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Chef etablissement',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Ville',
            $client->getResponse()->getContent()
        );
    }

    public function testListe() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/unicef/etablissement/accueil');

        $this->assertContains(
            'Ville',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Nom',
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

        $crawler = $client->request('GET', '/unicef/etablissement/ajouter');
        $form = $crawler->selectButton('school_save')->form();
        $form['school[nom]'] = 'INSA';
        $form['school[ville]'] = 'Rouen';
        $form['school[chefEtablissement]'] = 'Moi';
        $form['school[nbEleve]'] = '5000';
        $crawler = $client->submit($form);

        $this->assertTrue($client->getResponse()->isRedirect());
        $crawler = $client->followRedirect();

        $this->assertContains(
            'Félicitation',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Etablissement bien enregistrée.',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'INSA',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Rouen',
            $client->getResponse()->getContent()
        );



        $link = $crawler->filter('.navbar+div a[href*="/unicef/etablissement/details"]')->last()->link();
        $crawler = $client->click($link);

        $this->assertContains(
            'INSA',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Rouen',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Moi',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            '5000',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Nom',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Ville',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Chef d\'établissement',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Nombre d\'élèves',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Supprimer l\'établissement',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Retour à la liste',
            $client->getResponse()->getContent()
        );



        $link = $crawler->filter('table a[href*="/unicef/etablissement/accueil"]')->last()->link();
        $crawler = $client->click($link);
        $link = $crawler->filter('.navbar+div a[href*="/unicef/etablissement/supprimer"]')->last()->link();
        $crawler = $client->click($link);
        $this->assertTrue($client->getResponse()->isRedirect());
        $crawler = $client->followRedirect();

        $this->assertContains(
            'Félicitation',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Etablissement bien supprimé',
            $client->getResponse()->getContent()
        );

        $this->assertNotContains(
            'INSA',
            $client->getResponse()->getContent()
        );
    }
}
