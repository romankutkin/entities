<?php

namespace App\Tests\Entity;

use App\Entity\Flashcard;
use Faker\Factory;
use Faker\Generator;
use PHPUnit\Framework\TestCase;

class FlashcardTest extends TestCase
{
    public function testAccessors(): void
    {
        /** @var Generator $faker */
        $faker = Factory::create();

        $assertions = [
            'question' => $faker->word(),
            'answer' => $faker->word(),
            'createdAt' => $faker->dateTimeBetween('-1 year', 'now'),
            'updatedAt' => $faker->dateTimeBetween('-1 year', 'now'),
        ];

        $flashcard = new Flashcard();

        $flashcard
            ->setQuestion($assertions['question'])
            ->setAnswer($assertions['answer'])
            ->setCreatedAt($assertions['createdAt'])
            ->setUpdatedAt($assertions['updatedAt'])
        ;

        $this->assertEquals($assertions['question'], $flashcard->getQuestion());
        $this->assertEquals($assertions['answer'], $flashcard->getAnswer());
        $this->assertEquals($assertions['createdAt'], $flashcard->getCreatedAt());
        $this->assertEquals($assertions['updatedAt'], $flashcard->getUpdatedAt());
    }
}
