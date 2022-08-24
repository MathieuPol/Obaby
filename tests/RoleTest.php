<?php

namespace App\Tests;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class RoleTest extends WebTestCase
{
//? Explanation:
// Here we test the role of the user whitch are granted to access B-O.
// If you run the command: php bin/phpunit tests/RoleTest.php you will have 1 failure.



    /**
     * @dataProvider getRole
     * test  role who can access to BO
     *
     * @return void
     */
    public function testRoleUserNotAllowedBackOffice($role): void
    {
        // create client
        $client = static::createClient();

        // get user Repository
        $UserRepository = static::getContainer()->get(UserRepository::class);

        // get user
        $user = $UserRepository->findOneBy(['email' => $role]);

        // login user
        $client->loginUser($user);

        // get back office page
        $client->request('GET', '/back');

        // check if not user you access the back office
        //* user with role Admin and Moderator can access to back office (1 failure)
        //$this->assertResponseStatusCodeSame(Response::HTTP_MOVED_PERMANENTLY);

        //* user with role User can not access to back office (2 failure)
        $this->assertResponseStatusCodeSame(Response::HTTP_FORBIDDEN);
    }

    /**
     * Getting roles via dataprovider
     *
     */
    public function getRole()
    {
        yield ['git@git.com'];
        yield ['admin@admin.com'];
        yield ['obaby@gmail.com'];
    }


}
