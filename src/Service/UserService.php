<?php

namespace App\Service;

use App\DTO\LoginDTO;
use App\DTO\UserDTO;
use App\Entity\User;
use App\Entity\Users;
use App\Repository\UsersRepository;
use Exception;


class UserService
{
    public function __construct(
        private readonly UsersRepository $usersRepository,
    )
    {
    }

    /**
     * @throws Exception
     */
    public function create(UserDTO $userDTO): Users
    {
        $user = $this->usersRepository->findOneBy(['email' => $userDTO->email]);
        if (null !== $user) {
            throw new Exception('User already exists', 409);
        }

        $token = (string)random_int(100000, 999999);

        $user = (new Users())
            ->setEmail($userDTO->email)
            ->setToken($token)
            ->setName($userDTO->name)
            ->setSex($userDTO->sex)
            ->setAge($userDTO->age);

        $this->usersRepository->save($user);

        return $user;
    }

    /**
     * @throws Exception
     */
    public function show(int $userId): Users
    {
        /** @var ?Users $user */
        $user = $this->usersRepository->find($userId);
        if (null === $user) {
            throw new Exception('User not found', 404);
        }

        return $user;
    }

    /**
     * @throws Exception
     */
    public function edit(int $userId, UserDTO $userDTO): Users
    {
        /** @var ?Users $user */
        $user = $this->usersRepository->find($userId);
        if (null === $user) {
            throw new Exception('User not found', 404);
        }
        $user
            ->setEmail($userDTO->email)
            ->setName($userDTO->name)
            ->setSex($userDTO->sex)
            ->setAge($userDTO->age);

        return $user;
    }

    /**
     * @throws Exception
     */
    public function delete(int $userId): void {
        /** @var ?Users $user */
        $user = $this->usersRepository->find($userId);
        if (null === $user) {
            throw new Exception('User not found', 404);
        }
        $this->usersRepository->delete($user);
    }

    /**
     * @throws Exception
     */
    public function authenticate(LoginDTO $loginDTO): void
    {
        $user = $this->usersRepository->findOneBy(['email' => $loginDTO->email]);

        if (null === $user) {
            throw new Exception('User not found', 404);
        }
        if($loginDTO->token !== $user->getToken()) {
            throw new Exception('Wrong token', 401);
        }
    }
}