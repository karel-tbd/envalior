<?php

namespace App\Entity\Trait;

use Doctrine\ORM\Mapping as ORM;

trait NameTrait
{
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    public function __toString(): string
    {
        return $this->name;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}