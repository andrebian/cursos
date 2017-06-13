<?php

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\User;
use PHPUnit\Framework\TestCase;

/**
 * Class UserTest
 * @package Tests\AppBundle\Entity
 */
class UserTest extends TestCase
{
    public function testGettersAndSetters()
    {
        $data = [
            'id' => 1,
            'name' => 'Test',
            'username' => 'test@test.com.br'
        ];

        $entity = new User($data);

        $this->assertNotNull($entity->getId());
        $this->assertNotNull($entity->getName());
        $this->assertNotNull($entity->getUsername());
    }
}
