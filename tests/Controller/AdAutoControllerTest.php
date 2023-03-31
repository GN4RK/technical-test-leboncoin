<?php
namespace App\Tests\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdAutoControllerTest extends WebTestCase
{
    public function testCreateAdAuto(): void
    {
        $client = new Client(['verify' => false]);

        $data = [
            'title' => 'Test Ad Auto',
            'content' => 'This is a test ad for an auto.',
            'model' => 'ds4'
        ];

        $response = $client->post("https://localhost:8000/api/autos", [
            RequestOptions::JSON => $data
        ]);
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals("application/json", $response->getHeader('content-type')[0]);
    }

    public function testGetAdAutoList(): void
    {
        $client = new Client(['verify' => false]);
        $response = $client->request('GET', 'https://localhost:8000/api/autos');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals("application/json", $response->getHeader('content-type')[0]);
        
    }

    public function testGetAdAutoDetails(): void
    {
        $client = new Client(['verify' => false]);
        $response = $client->request('GET', 'https://localhost:8000/api/autos/1');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals("application/json", $response->getHeader('content-type')[0]);
        
    }

    public function testUpdateAdAuto(): void
    {
        $client = new Client(['verify' => false]);

        $data = [
            'title' => 'Update Ad Auto',
            'content' => 'This is a test ad for an auto.',
            'model' => 'ds4'
        ];

        $response = $client->put("https://localhost:8000/api/autos/1", [
            RequestOptions::JSON => $data
        ]);
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals("application/json", $response->getHeader('content-type')[0]);
    }

    public function testDeleteAdAuto(): void
    {
        $client = new Client(['verify' => false]);

        $data = [
            'title' => 'Test Ad Auto',
            'content' => 'This is a test ad for an auto.',
            'model' => 'ds4'
        ];

        // creating new ad
        $response = $client->post("https://localhost:8000/api/autos", [
            RequestOptions::JSON => $data
        ]);

        // getting new ad id
        $idNewAd = json_decode((string)$response->getBody())->id;

        // deleting the ad created
        $response = $client->delete("https://localhost:8000/api/autos/$idNewAd");
        
        $this->assertEquals(204, $response->getStatusCode());
    }
}