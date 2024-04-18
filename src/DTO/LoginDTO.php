<?php

declare(strict_types=1);

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class LoginDTO
{
    #[Assert\Type(type: 'string', message: 'Token must be a string.')]
    #[Assert\Regex(
        pattern: '/^\d+$/',
        message: 'Token must contain only digits.'
    )]
    public int $id;

    #[Assert\NotBlank(message: 'Email cannot be empty.')]
    #[Assert\Regex('/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/')]
    public string $email;

    #[Assert\Type(type: 'string', message: 'Token must be a string.')]
    #[Assert\Regex(
        pattern: '/^\d+$/',
        message: 'Token must contain only digits.'
    )]
    public string $token;
}