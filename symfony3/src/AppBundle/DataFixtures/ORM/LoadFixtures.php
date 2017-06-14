<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Fixtures;

/**
 * Class LoadFixtures
 * @package AppBundle\DataFixtures\ORM
 */
class LoadFixtures implements FixtureInterface
{

    /**
     * @inheritdoc
     */
    public function load(ObjectManager $manager)
    {
        Fixtures::load(__DIR__ . '/fixtures.yml', $manager);
    }
}
