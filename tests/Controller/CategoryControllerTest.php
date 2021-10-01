<?php

namespace App\Tests\Home;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CategoryControllerTest extends WebTestCase
{
   public function testNewCategoryController()
   {
       $client = static::createClient(); // Your app is automatically started using the built-in web server
       $client->request('GET', '/categories/new');

       $this->assertSame(200, $client->getResponse()->getStatusCode()); // You can use any PHPUnit assertion
   }

   /**
    * @dataProvider validUrlProvider
    */
    public function testPageIsSuccessful($url)
    {
        $client = self::createClient();
        $client->request('GET', $url);
 
        $this->assertTrue($client->getResponse()->isSuccessful());
    }
 
   public function validUrlProvider()
   {
       return [
           ['/categories/Horreur'],
           ['/categories/Anime'],
       ];
   }

}
