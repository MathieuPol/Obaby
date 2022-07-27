<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use App\Entity\Category;
use App\Entity\Question;
use App\Entity\Answer;
use App\Entity\Practice;
use App\Entity\User;

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
        $userList = [];






        // Category creation

            $category1 = new Category();
            $category1->setName('Grossesse');
            $manager->persist($category1);
            $categoryList[] = $category1;

            $category2 = new Category();
            $category2->setName('Sécurité');
            $manager->persist($category2);
            $categoryList[] = $category2;

            $category3 = new Category();
            $category3->setName('Nutrition');
            $manager->persist($category3);
            $categoryList[] = $category3;

            $category4 = new Category();
            $category4->setName('Santé');
            $manager->persist($category4);
            $categoryList[] = $category4;

            $category5 = new Category();
            $category5->setName('Loisir');
            $manager->persist($category5);
            $categoryList[] = $category5;
            



        // Question creation

        for ($j = 0; $j < 30; $j++) {
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

        for ($k = 0; $k < 30; $k++) {
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

        for($l = 0; $l < 30; $l++) {
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
        // User creation

            $userAdmin = new User();
            $userAdmin->setEmail('admin@admin.com');
            $userAdmin->setPseudo('admin');
            $userAdmin->setPassword('$2y$13$B5F2MaAidY68n5uqLEfrKeom.VARDRos.mEdgvWZWTTRXztOatBnq');
            $userAdmin->setStatus(1);
            $userAdmin->setRoles(['ROLE_ADMIN']);

            $userModetaror = new User();
            $userModetaror->setEmail('moderatior@moderator.com');
            $userModetaror->setPseudo('moderator');
            $userModetaror->setPassword('$2y$13$4aEMwhxQrZhkpKlDwtbfvOIDi8k5yoniNLV/Qb7xfUfCuHb2dgC2i');
            $userModetaror->setStatus(1);
            $userModetaror->setRoles(['ROLE_MODERATOR']);

            $userUser = new User();
            $userUser->setEmail('user@user.com');
            $userUser->setPseudo('user');
            $userUser->setPassword('$2y$13$vAX65eah5osvbxoLSY.QGO2TpbCNQgMs4blP6WZ0zwPXt7gUnERSC');
            $userUser->setStatus(1);
            $userUser->setRoles(['ROLE_USER']);


			$manager->persist($userAdmin);
            $manager->persist($userModetaror);
            $manager->persist($userUser);


        $manager->flush();
    }
}
