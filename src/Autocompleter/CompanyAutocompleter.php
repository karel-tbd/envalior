<?php

namespace App\Autocompleter;

use App\Entity\Company;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;
use Symfony\UX\Autocomplete\EntityAutocompleterInterface;

#[AutoconfigureTag('ux.entity_autocompleter', ['alias' => 'company'])]
class CompanyAutocompleter implements EntityAutocompleterInterface
{
    public function getEntityClass(): string
    {
        return Company::class;
    }

    public function createFilteredQueryBuilder(EntityRepository $repository, string $query): QueryBuilder
    {
        return $repository
            ->createQueryBuilder('c')
            ->andWhere('c.name LIKE :search')
            ->setParameter('search', '%' . $query . '%');
    }

    public function getLabel(object $entity): string
    {
        return $entity->getName();
    }

    public function getValue(object $entity): string
    {
        return $entity->getId();
    }

    public function isGranted(Security $security): bool
    {
        return true;
    }
}