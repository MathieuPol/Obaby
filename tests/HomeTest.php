<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class HomeTest extends WebTestCase
{
    public function testHome(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');


        //I check if the page is accessible with a 200 status code
        $this->assertResponseIsSuccessful();

        $this->assertSelectorTextContains('h1', 'Dernières questions posées par la communauté');
    }

    public function testRedirectionLogin(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/back');
        
        $this->assertResponseRedirects('/login', Response::HTTP_FOUND);
    }
}
