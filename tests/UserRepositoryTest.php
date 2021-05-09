<?php

namespace App\Tests;


use App\DataFixtures\UserFixtures;
use App\Repository\UserRepository;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserRepositoryTest extends KernelTestCase
{
	#THIS TRAIT COMES LIIPTESTFIXTURESBUNDLES WITH METHOD LOADFIXTURES
    use FixturesTrait;

    public function testcount(): void
    {
        self::bootKernel();

        //$this->loadFixtures([UserFixtures::class]);
        $this->loadFixtureFiles([
        	__DIR__.'/UserRepositoryTestFixtures.yaml'
        ]);
        $users = self::$container->get(UserRepository::class)->count([]);
        //dd($users);

        $this->assertEquals(10, $users);
    }
}
