<?php

namespace Tests\Functional\AppBundle;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class ApiExampleStatus
 * @package Tests\Functional\AppBundle
 */
class ApiExampleStatusTest extends WebTestCase
{
    /**
     * @test
     */
    public function status()
    {
        $client = self::createClient();

        $client->request('GET', '/api/status');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertTrue($client->getResponse()->headers->contains('Content-Type', 'application/json'), 'The response is not in a valid json format: Missing "Content-Type" header.');
        $this->assertContains('hash', $client->getResponse()->getContent());
    }
}
