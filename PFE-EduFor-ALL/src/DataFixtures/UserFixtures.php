<?php

namespace App\DataFixtures;
use App\Entity\User;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
class UserFixtures extends Fixture

{
       private $pass;
    public function __construct(UserPasswordEncoderInterface $passewordEncoder){
       $this->pass= $passewordEncoder;

    }
    public function load(ObjectManager $manager ): void
    {
        $user = new User();
        $user->setNom("test");
        $user->setPrenom("test");
        $user->setNomEcole("test");
        $user->setEmail("test@gmail.com");
        $role=[];
        $role[]='test';
        $user->setRoles($role);
        $passeword=$this->pass->encodePassword($user,"123456789"); 
        $user->setPassword($passeword);



         $manager->persist($user);

        $manager->flush();
    }
}
