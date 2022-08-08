<?php
// src/Controller/Front/AnswerController 

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use App\Entity\Category;
use App\Entity\Question;
use App\Entity\Answer;
use App\Entity\Practice;
use App\Entity\User;
use App\Services\SlugService;
use Doctrine\DBAL\Connection;
use Symfony\Component\String\Slugger\SluggerInterface;

class AppFixtures extends Fixture
{
    //* Used in dev environment to generate fake data

    private $slug;
    private $slugService;
    private $connection;
    
    public function __construct(SluggerInterface $slug, SlugService $slugService, Connection $connection) {
        $this->slug = $slug;
        $this->slugService = $slugService;
        $this->connection = $connection;
    }
    
    //* Used to set id to 1 each time the fixtures are loaded
    private function truncate()
    {
        //* disable foreign key check for this connection before truncating the tables
        $this->connection->executeQuery('SET FOREIGN_KEY_CHECKS = 0');
        $this->connection->executeQuery('TRUNCATE TABLE category');
        $this->connection->executeQuery('TRUNCATE TABLE question');
        $this->connection->executeQuery('TRUNCATE TABLE answer');
        $this->connection->executeQuery('TRUNCATE TABLE practice');
        $this->connection->executeQuery('TRUNCATE TABLE user');
        $this->connection->executeQuery('SET FOREIGN_KEY_CHECKS = 1');
    }


    public function load(ObjectManager $manager): void
    {
        //Add truncate function to set id to 1
        $this->truncate();

        // Instaciation faker factory
        $faker = Faker\Factory::create('fr_FR');

        $categoryList = [];
        $questionList = [];
        $answerList = [];
        $practiceList = [];
        $userList = [];

        // User creation
        $genre = ['homme', 'femme'];

        $userAdmin = new User();
        $userAdmin->setEmail('admin@admin.com');
        $userAdmin->setPseudo('admin');
        $userAdmin->setSlug($this->slugService->slug($userAdmin->getPseudo()));
        $userAdmin->setPassword('$2y$13$B5F2MaAidY68n5uqLEfrKeom.VARDRos.mEdgvWZWTTRXztOatBnq');
        $userAdmin->setStatus(1);
        $userAdmin->setGenre($genre[0]);
        $userAdmin->setRoles(['ROLE_ADMIN']);
        $userList[] = $userAdmin;

        $userModerator = new User();
        $userModerator->setEmail('moderator@moderator.com');
        $userModerator->setPseudo('moderator');
        $userModerator->setSlug($this->slugService->slug($userModerator->getPseudo()));
        $userModerator->setPassword('$2y$13$4aEMwhxQrZhkpKlDwtbfvOIDi8k5yoniNLV/Qb7xfUfCuHb2dgC2i');
        $userModerator->setGenre($genre[1]);
        $userModerator->setStatus(1);
        $userModerator->setRoles(['ROLE_MODERATOR']);
        $userList[] = $userModerator;

        $userUser = new User();
        $userUser->setEmail('user@user.com');
        $userUser->setPseudo('user');
        $userUser->setSlug($this->slugService->slug($userUser->getPseudo()));
        $userUser->setPassword('$2y$13$vAX65eah5osvbxoLSY.QGO2TpbCNQgMs4blP6WZ0zwPXt7gUnERSC');
        $userUser->setGenre($genre[1]);
        $userUser->setStatus(1);
        $userUser->setRoles(['ROLE_USER']);
        $userList[] = $userUser;

        $userAnonymous = new User();
        $userAnonymous->setEmail('obaby@gmail.com');
        $userAnonymous->setPseudo('Anonymous');
        $userAnonymous->setSlug($this->slugService->slug($userAnonymous->getPseudo()));
        $userAnonymous->setPassword('$2y$13$SQCAsxHo2Pwk9vAnSpMIxuCQvBrAE.ekHEYE5eKL/ChksQASPJ1cS');
        $userAnonymous->setGenre($genre[0]);
        $userAnonymous->setStatus(1);
        $userAnonymous->setRoles(['ROLE_USER']);
        $userList[] = $userAnonymous;
        
        $manager->persist($userAdmin);
        $manager->persist($userModerator);
        $manager->persist($userUser);
        $manager->persist($userAnonymous);


        // Category creation
        
        $category1 = new Category();
        $category1->setName('Grossesse');
        $categorySlug1 = $this->slug->slug($category1->getName())->lower();
        $category1->setSlug($categorySlug1);
        $manager->persist($category1);
        $categoryList[] = $category1;
        
        $category2 = new Category();
        $category2->setName('Sécurité');
        $categorySlug2 = $this->slug->slug($category2->getName())->lower();
        $category2->setSlug($categorySlug2);
        $manager->persist($category2);
        $categoryList[] = $category2;
        
        $category3 = new Category();
        $category3->setName('Nutrition');
        $categorySlug3 = $this->slug->slug($category3->getName())->lower();
        $category3->setSlug($categorySlug3);
        $manager->persist($category3);
        $categoryList[] = $category3;
        
        $category4 = new Category();
        $category4->setName('Santé et soins');
        $categorySlug4 = $this->slug->slug($category4->getName())->lower();
        $category4->setSlug($categorySlug4);
        $manager->persist($category4);
        $categoryList[] = $category4;
        
        $category5 = new Category();
        $category5->setName('Loisir');
        $categorySlug5= $this->slug->slug($category5->getName())->lower();
        $category5->setSlug($categorySlug5);
        $manager->persist($category5);
        $categoryList[] = $category5;
        
        $category6 = new Category();
        $category6->setName('Sommeil');
        $categorySlug6= $this->slug->slug($category6->getName())->lower();
        $category6->setSlug($categorySlug6);
        $manager->persist($category6);
        $categoryList[] = $category6;
            
        
        // Question creation
        
        for ($j = 0; $j < 30; $j++) {
            $question = new Question();
            $question->setContent($faker->sentence(true));
            $question->setCategory($categoryList[array_rand($categoryList)]);
            $date = $faker->date('Y-m-d');
            $question->setCreatedAt(new \DateTime($date));
            $question->setStatus($faker->numberBetween(0, 1));
            $question->setUser($userList[array_rand($userList)]);
            
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
            $answer->setUser($userList[array_rand($userList)]);
            
            $manager->persist($answer);
            $answerList[] = $answer;
        }

        // Practice creation

        $pictureList = [
            'baby1.png',
            'baby2.png',
            'baby3.png',
            'baby4.png',
            'baby5.png',
            'baby6.png',
            'baby7.png',
            'baby8.png',
            'baby9.png',
            'baby10.png',
            'baby11.png',
            'phone-1400.png',
            'enfant-1400.jpg',
            'ecrire-1400.png',
        ];
        
        for($l = 0; $l < 30; $l++) {
            $practice = new Practice();
            $practice->setPicture($pictureList[array_rand($pictureList)]);
            $practice->setTitle($faker->sentence(true));
            $practice->setSlug($this->slugService->slug($practice->getTitle()));
            $practice->setContent($faker->paragraph(3));
            $practice->setCategory($categoryList[array_rand($categoryList)]);
            $datePractice = $faker->date('Y-m-d');
            $practice->setCreatedAt(new \DateTime($datePractice));
            $practice->setStatus($faker->numberBetween(0, 1));
            $practice->setUser($userList[array_rand($userList)]);

            $manager->persist($practice);
            $practiceList[] = $practice;
        }

        $manager->flush();
    }
}