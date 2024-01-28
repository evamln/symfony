<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = [
            'admin@gmail.com',['ROLE_ADMIN'], '$2y$13$xLAIEyh3EZrPGy7uNLnlq.2AuIbp6y62BTHHNV9F.4LS8jvoYsJC2'
        ];
// password : $2y$13$xLAIEyh3EZrPGy7uNLnlq.2AuIbp6y62BTHHNV9F.4LS8jvoYsJC2
        $users = new User();
        $users->setEmail($user[0]);
        $users->setRoles($user[1]);
        $users->setPassword($user[2]);
        $manager->persist($users);
        $manager->flush();
    }
}
