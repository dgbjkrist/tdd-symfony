<?php

namespace App\Tests\Entity;

use App\Entity\InvitationCode;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validation;

class InvitationCodeTest extends KernelTestCase
{
	use FixturesTrait;

	public function getEntity(): InvitationCode
	{
		return (new InvitationCode())
				->setDescription('desccription du code')
				->setCode('12345')
				->setExpireAt(new \DateTime());

	}

	public function assertHasErrors($code, $number)
	{
		self::bootkernel();

		$validator = Validation::createValidator();
		
		$errors = self::$container->get('validator')->validate($code);

		$violations = $validator->validate();

		$this->assertCount($number, $errors);
	}

    public function testValidCode(): void
    {
    	$this->assertHasErrors($this->getEntity(), 0);

    }

    public function testInvalidCode(): void
    {
    	$this->assertHasErrors($this->getEntity()->setCode('1234R'), 1);
    	$this->assertHasErrors($this->getEntity()->setCode('1234sdf'), 1);
    	$this->assertHasErrors($this->getEntity()->setCode(''), 1);
    }

    public function testUsedInvitationCode()
    {
    	$invitationCode = $this->loadFixtureFiles([
    		dirname(__DIR__).'/Fixtures/InvitationCodeRepositoryFixtures.yaml'
    	]);
    	///self::$container->get();
    	$this->assertHasErrors($this->getEntity()->setCode('14253'), 1);
    }
}
