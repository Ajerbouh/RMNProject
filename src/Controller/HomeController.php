<?php

namespace App\Controller;

use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        $client = new Client();

        $response = $client->request('GET', 'https://api.art.rmngp.fr/v1/works/69885', [
            'headers' => [
                'ApiKey' => $_ENV['API_KEY']
            ]
        ]);
        $data = \GuzzleHttp\json_decode($response->getBody());

        return $this->render('home/index.html.twig', [
            'videos' => $data,
        ]);
    }
}
