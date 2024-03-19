<?php

namespace App\DataFixtures;

use App\Entity\Feedback;
use App\Entity\Infoday;
use App\Entity\Interest;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //adding the 3 infodays
        $infoday1 = new Infoday();
        $infoday1->setDate(new \DateTime('2023-05-25'));
        $infoday2 = new Infoday();
        $infoday2->setDate(new \DateTime('2023-06-24'));
        $infoday3 = new Infoday();
        $infoday3->setDate(new \DateTime('2023-02-09'));

        $infodays = [$infoday1, $infoday2, $infoday3];
        $manager->persist($infoday1);
        $manager->persist($infoday2);
        $manager->persist($infoday3);

        //adding the 4 interests
        $interest1 = new Interest();
        $interest1->setName('Mechanics');
        $interest2 = new Interest();
        $interest2->setName('Electronics');
        $interest3 = new Interest();
        $interest3->setName('ICT');
        $interest4 = new Interest();
        $interest4->setName('Chemistry');

        $interests = [$interest1, $interest2, $interest3, $interest4];
        $manager->persist($interest1);
        $manager->persist($interest2);
        $manager->persist($interest3);
        $manager->persist($interest4);


        for($i = 0; $i < 100; $i++) {

            $faker = Factory::create();
            $infoday = $faker->randomElement($infodays);
            $user = new User();
            $user->setEmail($faker->email())
                ->setUsername($faker->userName())
                ->setPassword($faker->password())
                ->setFirstName($faker->firstName())
                ->setLastName($faker->lastName())
                ->setBirthday($faker->dateTimeBetween('-30 years', '-18 years'))
                ->setIsVerified(true)
                ->setInfoday($infoday);

            $feedback = new Feedback();
            $feedback->setUser($user)
                ->setRating($faker->numberBetween(1, 5))
                ->setComment($faker->text())
                ->addInterest($faker->randomElement($interests));

            $manager->persist($user);
            $manager->persist($feedback);
        }


        $manager->flush();
    }
}
