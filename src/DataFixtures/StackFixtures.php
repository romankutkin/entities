<?php

namespace App\DataFixtures;

use App\Entity\Flashcard;
use App\Entity\Stack;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class StackFixtures extends Fixture
{
    /**
     * @var Generator
     */
    private $faker;

    public function load(ObjectManager $manager)
    {
        $this->faker = Factory::create();

        for ($i = 0; $i < 128; $i++) {
            $stack = new Stack();

            $createdAt = $this->faker->dateTimeBetween('-1 year', 'now');
            $updatedAt = $this->faker->dateTimeBetween($createdAt, 'now');

            $stack
                ->setTitle($this->faker->sentence(3))
                ->setCreatedAt($createdAt)
                ->setUpdatedAt($updatedAt)
            ;

            $flashcardRepository = $manager->getRepository(Flashcard::class);
            $flashcards = $flashcardRepository->findAll();

            for ($j = 0; $j < 32; $j++) {
                $index = array_rand($flashcards);

                $stack
                    ->addFlashcard($flashcards[$index])
                ;
            }

            $manager->persist($stack);
        }

        $manager->flush();
    }
}
