<?php

declare(strict_types=1);

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class CreateKnightRequest
{
    #[Assert\NotBlank(message: 'The name field is required')]
    #[Assert\Type('string')]
    #[Assert\Length(min: 1, max: 255)]
    public string $name;

    #[Assert\NotNull(message: 'The strength field is required')]
    #[Assert\Type('integer')]
    #[Assert\GreaterThanOrEqual(0)]
    public int $strength;

    #[Assert\NotNull(message: 'The weapon_power field is required')]
    #[Assert\Type('integer')]
    #[Assert\GreaterThanOrEqual(0)]
    public int $weapon_power;
}
