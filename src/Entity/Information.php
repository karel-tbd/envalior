<?php

namespace App\Entity;

use App\Entity\Trait\BlameableTrait;
use App\Entity\Trait\DefaultTrait;
use App\Repository\InformationRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use libphonenumber\PhoneNumber;
use Symfony\Component\Validator\Constraints\NotBlank;

#[ORM\Entity(repositoryClass: InformationRepository::class)]
class Information
{

    use DefaultTrait;
    use TimestampableEntity;
    use BlameableTrait;

    #[ORM\Column(length: 255)]
    private ?string $fullName = null;

    #[ORM\Column(type: 'phone_number')]
    #[NotBlank]
    private ?PhoneNumber $phoneNumber = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(nullable: true)]
    private ?int $hierarchy = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type = null;

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): static
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getPhoneNumber(): ?PhoneNumber
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?PhoneNumber $phoneNumber): static
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getHierarchy(): ?int
    {
        return $this->hierarchy;
    }

    public function setHierarchy(?int $hierarchy): static
    {
        $this->hierarchy = $hierarchy;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): static
    {
        $this->type = $type;

        return $this;
    }
}
