<?php

namespace App\Tests\Unit;

use App\Entity\Feedback;
use App\Entity\Infoday;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class InfodayEntityTest extends TestCase
{
    public function getEntity() : Infoday
    {
        $infoday =(new Infoday(new \DateTime('2021-01-01')))
            ->setId(1)
            ->setDate(new \DateTime('2022-06-02'));


        $user = (new User())
            ->setId(1)
            ->setBirthday(new \DateTime('1999-01-01'))
            ->setEmail('test@gmail.com')
            ->setUsername('test')
            ->setFirstName('test')
            ->setLastName('test')
            ->setPassword('123456')
            ->setRoles(['ROLE_USER'])
            ->setIsVerified(true)
            ->setInfoday($infoday);

        $infoday->addUser($user);

        return $infoday;

    }

    public function testDate(): void
    {
        $infoday = $this->getEntity();

        $this->assertEquals(new \DateTime('2022-06-02'), $infoday->getDate());
    }

    public function testId(): void
    {
        $infoday = $this->getEntity();

        $this->assertEquals(1, $infoday->getId());
    }

    /*public function testAddFeedback(): void
    {
        $infoday = $this->getEntity();

        $this->assertCount(1, $infoday->getFeedback());
    }*/

    public function testAddUser(): void
    {
        $infoday = $this->getEntity();

        $this->assertCount(1, $infoday->getUsers());
    }

    /*public function testRemoveFeedback(): void
    {
        $infoday = $this->getEntity();
        $infoday->removeFeedback($infoday->getFeedback()[0]);

        $this->assertCount(0, $infoday->getFeedback());
    }*/

    public function testToString(): void
    {
        $infoday = $this->getEntity();

        $this->assertEquals('02-06-2022', $infoday->__toString());
    }



}
