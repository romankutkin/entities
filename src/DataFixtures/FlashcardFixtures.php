<?php

namespace App\DataFixtures;

use App\Entity\Flashcard;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class FlashcardFixtures extends Fixture
{
    /**
     * @var Generator
     */
    private $faker;

    public function load(ObjectManager $manager)
    {
        $this->faker = Factory::create();

        for ($i = 0; $i < 1024; $i++) {
            $flashcard = new Flashcard();

            $createdAt = $this->faker->dateTimeBetween('-1 year', 'now');
            $updatedAt = $this->faker->dateTimeBetween($createdAt, 'now');

            $flashcard
                ->setQuestion($this->faker->word())
                ->setAnswer($this->faker->word())
                ->setCreatedAt($createdAt)
                ->setUpdatedAt($updatedAt)
            ;

            $manager->persist($flashcard);
        }

        $manager->flush();
    }
}
