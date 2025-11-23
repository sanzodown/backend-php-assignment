<?php

declare(strict_types=1);

/**
 * This file is part of a Upply project.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controller;

use App\DTO\CreateKnightRequest;
use App\Exception\KnightNotFoundException;
use App\Handler\KnightHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class KnightController extends AbstractController
{
    public function __construct(
        private readonly KnightHandler $knightHandler,
        private readonly ValidatorInterface $validator,
        private readonly SerializerInterface $serializer,
    ) {
    }

    #[Route('/knight', name: 'knight_create', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $contentType = $request->headers->get('Content-Type');

        if ($contentType && false === stripos($contentType, 'application/json')) {
            return $this->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'message' => 'Content-Type must be application/json',
            ], Response::HTTP_BAD_REQUEST);
        }

        $dto = $this->serializer->deserialize(
            $request->getContent(),
            CreateKnightRequest::class,
            'json'
        );

        $errors = $this->validator->validate($dto);

        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[] = $error->getMessage();
            }

            return $this->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'message' => implode(', ', $errorMessages),
            ], Response::HTTP_BAD_REQUEST);
        }

        $knight = $this->knightHandler->createKnight(
            $dto->name,
            $dto->strength,
            $dto->weapon_power
        );

        return $this->json([
            'id' => $knight->getId(),
            'name' => $knight->getName(),
            'strength' => $knight->getStrength(),
            'weapon_power' => $knight->getWeaponPower(),
        ], Response::HTTP_CREATED);
    }

    #[Route('/knight', name: 'knight_list', methods: ['GET'])]
    public function list(): JsonResponse
    {
        $knights = $this->knightHandler->listKnights();

        $result = [];
        foreach ($knights as $knight) {
            $result[] = [
                'id' => $knight->getId(),
                'name' => $knight->getName(),
                'strength' => $knight->getStrength(),
                'weapon_power' => $knight->getWeaponPower(),
            ];
        }

        return $this->json($result, Response::HTTP_OK);
    }

    #[Route('/knight/{id}', name: 'knight_get', methods: ['GET'])]
    public function get(string $id): JsonResponse
    {
        try {
            if (!Uuid::isValid($id)) {
                throw new KnightNotFoundException($id);
            }

            $knight = $this->knightHandler->getKnight($id);

            if (!$knight) {
                throw new KnightNotFoundException($id);
            }

            return $this->json([
                'id' => $knight->getId(),
                'name' => $knight->getName(),
                'strength' => $knight->getStrength(),
                'weapon_power' => $knight->getWeaponPower(),
            ], Response::HTTP_OK);
        } catch (KnightNotFoundException $e) {
            return $this->json([
                'code' => Response::HTTP_NOT_FOUND,
                'message' => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        }
    }
}
