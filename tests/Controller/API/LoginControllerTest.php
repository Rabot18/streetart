<?php

namespace App\Tests;

use Symfony\Component\Panther\PantherTestCase;

class LoginControllerTest extends PantherTestCase
{
//    public function testMyApp(): void
//    {
//        $client = static::createPantherClient(); // Your app is automatically started using the built-in web server
//        $client->request('GET', '/');
//
//        // Use any PHPUnit assertion, including the ones provided by Symfony
//        $this->assertPageTitleContains('Site de streetart');
////        $this->assertSelectorTextContains('#main', 'My body');
//    }

    public function testLogin(): void
    {
        $client = static::createClient(); // Your app is automatically started using the built-in web server
        $client->request('POST', '/api/login_check', [], [], [
            'CONTENT_TYPE' => 'application/json',
        ], json_encode([
            'username' => 'komlan',
            'password' => 'azerty',
        ]));

        var_dump($client->getResponse()->getContent());

        $this->assertResponseStatusCodeSame(200);

        // Use any PHPUnit assertion, including the ones provided by Symfony
//        $this->assertPageTitleContains('Site de streetart');
//        $this->assertSelectorTextContains('#main', 'My body');
    }
}
