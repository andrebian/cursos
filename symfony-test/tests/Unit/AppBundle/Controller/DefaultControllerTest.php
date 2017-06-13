<?php

namespace Tests\Unit\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DefaultControllerTest
 * @package Tests\AppBundle\Controller
 */
class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $url = '/';
        $client = static::createClient();
        $client->request('GET', $url);

        $this->assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode(),
            sprintf('The %s public URL loads correctly.', $url)
        );
    }
}