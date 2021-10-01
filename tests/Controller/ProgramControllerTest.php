<?php

namespace App\Tests\Home;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProgramControllerTest extends WebTestCase
{
   public function testNewProgramController()
   {
       $client = static::createClient(); // Your app is automatically started using the built-in web server
       $client->request('GET', '/programs/new');

       $this->assertSame(200, $client->getResponse()->getStatusCode()); // You can use any PHPUnit assertion
   }
}
