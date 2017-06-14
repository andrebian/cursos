<?php

namespace SONUser\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use SONUser\Entity\User;

/**
 * Class LoadUser
 * @package SONUser\Fixture
 */
class LoadUser extends AbstractFixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {

        print("\r\n - Importing data fixture to User .");
        $data = [
            'name' => 'Andre',
            'email' => 'andrecardosodev@gmail.com',
            'password' => 'andre123',
            'active' => 1,
        ];

        $user = new User($data);
        $manager->persist($user);
        $manager->flush();

        print(".");
        print(".");
        print(" Ok \r\n\r\n");
    }
}