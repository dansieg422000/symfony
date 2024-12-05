<?php

namespace App\DataFixtures;

use App\Factory\GlossTreasureFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        GlossTreasureFactory::createMany(50);
        UserFactory::createMany(10);
    }
}
