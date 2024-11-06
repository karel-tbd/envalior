<?php

namespace App\Entity;

use App\Entity\Trait\BlameableTrait;
use App\Entity\Trait\DefaultTrait;
use App\Repository\ContractRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: ContractRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Contract
{
    use DefaultTrait;
    use TimestampableEntity;
    use BlameableTrait;

    #[ORM\Column(length: 255)]
    private ?string $number = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $expiryDate = null;

    #[ORM\ManyToOne(inversedBy: 'contracts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Company $company = null;

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): static
    {
        $this->number = $number;

        return $this;
    }

    public function getExpiryDate(): ?\DateTimeImmutable
    {
        return $this->expiryDate;
    }

    public function setExpiryDate(?\DateTimeImmutable $expiryDate): static
    {
        $this->expiryDate = $expiryDate;

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): static
    {
        $this->company = $company;

        return $this;
    }
}
