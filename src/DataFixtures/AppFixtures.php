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
        UserFactory::createMany(10);
        GlossTreasureFactory::createMany(50, function () {
            return [
                'owner' => UserFactory::random(),
            ];
        });
    }
}
