<?php
declare(strict_types = 1);
namespace Infrastructure\Repository;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Infrastructure\Interfaces\ICategoriesRepository;

class CategoriesRepository implements ICategoriesRepository
{
    private EntityManager $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
}