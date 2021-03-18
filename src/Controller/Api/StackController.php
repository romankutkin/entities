<?php

namespace App\Controller\Api;

use App\Entity\Stack;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class StackController extends AbstractController
{
    public function create(Request $request, SerializerInterface $serializer): Response
    {
        $stack = $serializer->deserialize($request->getContent(), Stack::class, 'json');

        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->persist($stack);
        $entityManager->flush();

        return new JsonResponse([
            'id' => $stack->getId(),
        ]);
    }

    public function show($id): Response
    {
        $stackRepository = $this->getDoctrine()->getRepository(Stack::class);

        $stack = $stackRepository->find($id);

        if (!$stack) {
            return new JsonResponse(null, Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse($stack);
    }
}
