<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use App\Entity\Category;
use App\Entity\Question;
use App\Entity\Answer;
use App\Entity\Practice;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        // Instaciation faker factory
        $faker = Faker\Factory::create('fr_FR');

        $categoryList = [];
        $questionList = [];
        $answerList = [];
        $practiceList = [];

        // Category creation

        for ($i = 0; $i < 5; $i++) {
            $category = new Category();
            $category->setName($faker->word);
            $manager->persist($category);
            $categoryList[] = $category;
        }

        // Question creation

        for ($j = 0; $j < 10; $j++) {
            $question = new Question();
            $question->setContent($faker->sentence(true));
            $question->setCategory($categoryList[array_rand($categoryList)]);
            $date = $faker->date('Y-m-d');
            $question->setCreatedAt(new \DateTime($date));
            $question->setStatus($faker->numberBetween(0, 1));

            $manager->persist($question);
            $questionList[] = $question;
        }

        // Answer creation

        for ($k = 0; $k < 10; $k++) {
            $answer = new Answer();
            $answer->setContent($faker->paragraph(true));
            $dateAnswer = $faker->date('Y-m-d');
            $answer->setCreatedAt(new \DateTime($dateAnswer));
            $answer->setQuestion($questionList[array_rand($questionList)]);
            $answer->setStatus($faker->numberBetween(0, 1));

            $manager->persist($answer);
            $answerList[] = $answer;
        }

        // Practice creation

        for($l = 0; $l < 10; $l++) {
            $practice = new Practice();
            $practice->setTitle($faker->sentence(true));
            $practice->setContent($faker->paragraph(3));
            $practice->setCategory($categoryList[array_rand($categoryList)]);
            $datePractice = $faker->date('Y-m-d');
            $practice->setCreatedAt(new \DateTime($datePractice));
            $practice->setStatus($faker->numberBetween(0, 1));

            $manager->persist($practice);
            $practiceList[] = $practice;
        }

        $manager->flush();
    }
}
