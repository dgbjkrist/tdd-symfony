<?php

namespace App\Tests\Repository;


use App\DataFixtures\UserFixtures;
use App\Repository\UserRepository;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserRepositoryTest extends KernelTestCase
{
	#THIS TRAIT COMES LIIPTESTFIXTURESBUNDLES WITH METHOD LOADFIXTURES
    use FixturesTrait;

    public function testCount(): void
    {
        self::bootKernel();

        //$this->loadFixtures([UserFixtures::class]);
        /*
        $users = $this->loadFixtureFiles([
        	dirname(__DIR__).'/Fixtures/UserRepositoryTestFixtures.yaml'
        ]);
        */
        $users = self::$container->get(UserRepository::class)->count([]);
        //dd($users);

        $this->assertEquals(10, $users);
    }
}
