<?php

namespace App\Controller;

use App\Repository\VideosRepository;
use GuzzleHttp\Client;
use http\Env;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(VideosRepository $videosRepository)
    {
        $client = new Client();

        $response = $client->request('GET', 'https://api.art.rmngp.fr/v1/works/69885', [
            'headers' => [
                'ApiKey' => $_ENV['API_KEY']
            ]
        ]);
/*        echo '<pre>';
        var_dump(\GuzzleHttp\json_decode($response->getBody()));
        echo '</pre>';*/
        $data = \GuzzleHttp\json_decode($response->getBody());

        return $this->render('home/index.html.twig', [
            'videos' => $data,
        ]);
    }
}
