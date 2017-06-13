<?php

namespace Tests\Functional\AppBundle;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomePageActionsTest extends WebTestCase
{
    public function testShowPost()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Hello World")')->count()
        );
    }

    /**
     * @test
     */
    public function clickLink()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $link = $crawler
            ->filter('a:contains("Click me")')
            ->eq(0)
            ->link();

        $crawler = $client->click($link);
        $this->assertContains('Test', $crawler->filter('h1')->first()->text());
    }
}