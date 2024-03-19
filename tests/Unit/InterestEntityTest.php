<?php

namespace App\Tests\Unit;

use App\Entity\Feedback;
use App\Entity\Infoday;
use App\Entity\Interest;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class InterestEntityTest extends TestCase
{
    public function getEntity(): Interest
    {
        $interest = new Interest();
        $interest->setName('Electronics');
        return $interest;
    }
    public function testName(): void
    {
        $interest = $this->getEntity();
        $interest->setName('Electronics');
        $this->assertEquals('Electronics', $interest->getName());

    }
    public function testId(): void
    {
        $interest = $this->getEntity();
        $interest->setId(0);
        $this->assertEquals(0, $interest->getId());
    }

    public function testFeedback(): void
    {
        $interest = $this->getEntity();
        $feedback = new Feedback();

        $feedback->setRating(3)
                 ->setComment('test')
                 ->addInterest($interest);

        $interest->addFeedback($feedback);
        $this->assertCount(1, $interest->getFeedbacks());
    }
}
