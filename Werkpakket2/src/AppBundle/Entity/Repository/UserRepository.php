<?php
namespace AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function findAllCoaches()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT u FROM AppBundle:User u WHERE u.rolesString LIKE :role'
            )->setParameter('role', '%ROLE_COACH%')
            ->getResult();
    }
}