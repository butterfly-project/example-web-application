<?php

namespace Project\Repository;

use Project\Entity\User;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    /**
     * @param string $name
     * @return null|User
     */
    public function findByName($name)
    {
        return $this->findOneBy(array(
            'name' => $name,
        ));
    }
}
