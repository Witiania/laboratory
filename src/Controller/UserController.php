<?php

namespace App\Controller;

use App\DTO\LoginDTO;
use App\DTO\UserDTO;
use App\Service\UserService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/user', name: 'api_user')]
class UserController extends AbstractController {
    public function __construct(
        private readonly UserService $userService,
    ) {
    }

    /**
     * @throws Exception
     */
    #[Route('', name: 'api_user_new', methods: ['POST'])]
    public function create(#[MapRequestPayload] UserDTO $userDTO): JsonResponse {
        $user = $this->userService->create($userDTO);

        return $this->json($user);
    }

    /**
     * @throws Exception
     */
    #[Route('/{id}', name: 'api_user_show', methods: ['GET'])]
    public function show(int $id): JsonResponse {
        $user = $this->userService->show($id);

        return $this->json($user);
    }

    /**
     * @throws Exception
     */
    #[Route('/{id}', name: 'api_user_edit', methods: ['PUT'])]
    public function edit(#[MapRequestPayload] UserDTO $userDTO, int $id): JsonResponse {
        $user = $this->userService->edit($id, $userDTO);

        return $this->json($user);
    }

    /**
     * @throws Exception
     */
    #[Route('/{id}', name: 'api_user_delete', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse {
        $this->userService->delete($id);

        return $this->json('Success');
    }

    /**
     * @throws Exception
     */
    #[Route('/login', name: 'authorization', methods: ['POST'])]
    public function login(#[MapRequestPayload] LoginDTO $loginDTO): JsonResponse {
        $this->userService->authenticate($loginDTO);
        return $this->json('Success');
    }
}
