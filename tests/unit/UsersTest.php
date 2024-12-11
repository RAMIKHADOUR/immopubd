<?php

namespace App\Tests\unit;

use App\Entity\Users;
use new\DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UsersTest extends KernelTestCase
{
    public function testSomething(): void
    {
        self::bootKernel();
        $container = static::getContainer();
        $user = new Users();
        $user->setNom("#1")
                ->setPrenom("#1")
                ->setEmail("#1")
                ->setPassword("#1");
            
                $errors = $container->get('validator')->validate($user);
                $this->assertCount(0,$errors);
        
    }
}
