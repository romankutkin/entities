<?php

namespace App\Tests\Entity;

use App\Entity\Stack;
use Faker\Factory;
use Faker\Generator;
use PHPUnit\Framework\TestCase;

class StackTest extends TestCase
{
    public function testAccessors(): void
    {
        /** @var Generator $faker */
        $faker = Factory::create();

        $assertions = [
            'title' => $faker->sentence(3),
            'createdAt' => $faker->dateTimeBetween('-1 year', 'now'),
            'updatedAt' => $faker->dateTimeBetween('-1 year', 'now'),
        ];

        $stack = new Stack();

        $stack
            ->setTitle($assertions['title'])
            ->setCreatedAt($assertions['createdAt'])
            ->setUpdatedAt($assertions['updatedAt'])
        ;

        $this->assertEquals($assertions['title'], $stack->getTitle());
        $this->assertEquals($assertions['createdAt'], $stack->getCreatedAt());
        $this->assertEquals($assertions['updatedAt'], $stack->getUpdatedAt());
    }
}
