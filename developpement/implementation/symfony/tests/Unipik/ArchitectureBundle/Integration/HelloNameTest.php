<?php

namespace Tests\Unipik\ArchitectureBundle\Controller;

use Unipik\ArchitectureBundle\Controller\InterventionController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HelloNameTest extends WebTestCase {

    public function testLinkFromIndex() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/unicef/accueil');

        $link = $crawler->filter('.navbar+div a[href*="/hello/name"]')->eq(0)->link();

        $crawler = $client->click($link);

        $this->assertContains(
            'Hello Unicef !',
            $client->getResponse()->getContent()
        );

    }

    public function testLinkFromNavbar() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/unicef/accueil');

        $link = $crawler->filter('.navbar a[href*="/unicef/hello/name"]')->eq(0)->link();

        $crawler = $client->click($link);

        $this->assertContains(
            'Hello Unicef !',
            $client->getResponse()->getContent()
        );

    }

    public function testHelloUnicef() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/unicef/hello/name');

        $this->assertContains(
            'Hello Unicef !',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'Name',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            '<input',
            $client->getResponse()->getContent()
        );

        $this->assertContains(
            'name="name[name]',
            $client->getResponse()->getContent()
        );

    }

    public function testHelloName()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/unicef/hello/name');

        $form = $crawler->selectButton('name_Go')->form();

        $form['name[name]'] = 'Superman';

        $crawler = $client->submit($form);



        $this->assertContains(
            'Hello Superman !',
            $client->getResponse()->getContent()
        );
    }
}
