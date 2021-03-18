<?php

namespace App\Tests\Controller\Api;

use Faker\Factory;
use Faker\Generator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class StackControllerTest extends WebTestCase
{
    /**
     * @var array
     */
    static $assertions = [];

    public static function setUpBeforeClass(): void
    {
        /** @var Generator $faker */
        $faker = Factory::create();

        $createdAt = $faker->dateTimeBetween('-1 year', 'now');
        $updatedAt = $faker->dateTimeBetween($createdAt, 'now');

        self::$assertions = [
            'title' => $faker->sentence(5),
            'createdAt' => $createdAt->format('Y-m-d H:i:s'),
            'updatedAt' => $updatedAt->format('Y-m-d H:i:s'),
        ];
    }

    public function testCreate(): void
    {
        $client = static::createClient();

        $client->request(
            'POST',
            '/api/stacks',
            [],
            [],
            [],
            json_encode(self::$assertions)
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        self::$assertions['id'] = json_decode($client->getResponse()->getContent(), true)['id'];
    }

    public function testShow(): void
    {
        $client = static::createClient();

        $client->request(
            'GET',
            '/api/stacks/' . self::$assertions['id']
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
