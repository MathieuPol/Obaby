<?php

namespace App\Tests;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RoleTest extends WebTestCase
{

    /**
     * test  role who can access to BO
     *
     * @return void
     */
    public function testRoleUserNotAllowedBackOffice(): void
    {
        // create client
        $client = static::createClient();

        // get user Repository
        $UserRepository = static::getContainer()->get(UserRepository::class);

        // get user
        $user = $UserRepository->findOneBy(['email' => 'obaby@gmail.com']);

        // login user
        $client->loginUser($user);

        // get back office page
        $client->request('GET', '/back');

        // check if user is redirected to login page
        $this->assertEquals(403, $client->getResponse()->getStatusCode());
    }


}
