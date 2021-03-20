<?php

namespace App\Controller\Api;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    public function show(string $username): Response
    {
        $doctrine = $this->getDoctrine();

        $userRepository = $doctrine
            ->getRepository(User::class)
        ;

        $userMetadata = $doctrine
            ->getManager()
            ->getClassMetadata(User::class)
        ;

        $user = $userRepository->findOneBy([
            'username' => $username,
        ]);

        if (!$user) {
            return new JsonResponse([
                'errors' => 'not found'
            ], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse([
            'id' => $user->getId(),
            'type' => $userMetadata->table['name'],
            'attributes' => [
                'username' => $user->getUsername(),
                'first_name' => $user->getFirstName(),
                'last_name' => $user->getLastName(),
            ],
        ]);
    }
}
