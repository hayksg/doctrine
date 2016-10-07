<?php

namespace Admin\Model;

use Doctrine\ORM\EntityManager;

class CategoryTable
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getAllCategories()
    {
        $sql  = "SELECT c ";
        $sql .= "FROM Blog\Entity\Category c ";
        $sql .= "ORDER BY c.id ASC";

        $query = $this->entityManager->createQuery($sql);
        return ($query->getResult()) ? $query->getResult() : false;
    }
}
