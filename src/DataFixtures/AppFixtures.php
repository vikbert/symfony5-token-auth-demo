<?php

namespace App\DataFixtures;

use App\Factory\TodoFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        UserFactory::createOne();
        TodoFactory::createMany(10);
    }
}
