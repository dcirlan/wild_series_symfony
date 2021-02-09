<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Actor;
use App\DataFixtures\ProgramFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ActorFixtures extends Fixture implements DependentFixtureInterface
{
    const ACTORS = [
        'Andrew-Lincoln',
        'Norman-Reedus',
        'Lauren-Cohan',
        'Danai-Gurira',
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::ACTORS as $key => $actorName) {
            $actor = new Actor();
            $actor->setName($actorName);
            $actor->addProgram($this->getReference('program_' . rand(1, 5), $actor));
            $manager->persist($actor);
            $this->setReference('actor' . $key, $actor);
        }

        $faker = Faker\Factory::create('en_US');
        for($i=4;$i<=50;$i++) {
            $actor = new Actor();
            $actor->setName($faker->name());
            $actor->addProgram($this->getReference('program_' . rand(1, 5), $actor));
            $manager->persist($actor);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [ProgramFixtures::class];
    }
}