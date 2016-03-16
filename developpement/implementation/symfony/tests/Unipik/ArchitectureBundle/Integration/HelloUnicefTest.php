<?php

namespace Tests\Unipik\ArchitectureBundle\Controller;

use Unipik\ArchitectureBundle\Controller\InterventionController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HelloUnicefTest extends WebTestCase {

    public function testLinkFromIndexAction() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/unicef/accueil');

        $link = $crawler->filter('.navbar+div a[href*="/unicef/hello"]')->eq(0)->link();

        $crawler = $client->click($link);

        $this->assertContains(
            'Hello Unicef !',
            $client->getResponse()->getContent()
        );

    }

    public function testLinkFromNavbarAction() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/unicef/accueil');

        $link = $crawler->filter('.navbar a[href*="/unicef/hello"]')->eq(0)->link();

        $crawler = $client->click($link);

        $this->assertContains(
            'Hello Unicef !',
            $client->getResponse()->getContent()
        );

    }

    public function testHelloUnicefAction() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/unicef/hello');

        $this->assertContains(
            'Hello Unicef !',
            $client->getResponse()->getContent()
        );

    }

}
