<?php

namespace Tests\Unipik\ArchitectureBundle\Controller;

use Unipik\ArchitectureBundle\Controller\InterventionController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HelloUnicefTest extends WebTestCase {

    public function testLinkFromIndexAction() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/unicef/accueil');

        $link = $crawler->filter('a[href*=/]');




        //$this->assertTrue(TRUE);

    }

}
