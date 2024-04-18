<?php

declare(strict_types=1);

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class UserDTO
{
    #[Assert\NotBlank(message: 'Email cannot be empty.')]
    #[Assert\Regex('/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/')]
    public string $email;

    #[Assert\NotBlank(message: 'Name cannot be empty.')]
    #[Assert\Type(type: 'string', message: 'Name\'s value {{ value }} is not a string.')]
    #[Assert\Length(
        min: 2,
        max: 20,
        minMessage: 'Name must be not less than {{ limit }} characters.',
        maxMessage: 'Name must be not more than {{ limit }} characters.'
    )]
    public string $name;

    #[Assert\NotBlank(message: 'Sex cannot be empty.')]
    #[Assert\Choice(choices: ['male', 'female'], message: 'Choose a valid gender.')]
    public string $sex;

    #[Assert\NotBlank(message: 'Age cannot be empty.')]
    #[Assert\Type(type: 'int', message: 'Age\'s value {{ value }} is not a number.')]
    #[Assert\Range(min: 18, max: 110, notInRangeMessage: 'You must be at least {{ limit }} years old. You cannot be older than {{ limit }} years old.')]
    public int $age;
}