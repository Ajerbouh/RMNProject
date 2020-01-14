<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use GuzzleHttp\Client;
use http\Env;

class WorkController extends AbstractController
{
    /**
     * @Route("/work/{id}", name="work")
     */
    public function index($id)
    {
        $client = new Client();

//        var_dump("https://api.art.rmngp.fr/v1/works/{$id}");

        $response = $client->request('GET', "https://api.art.rmngp.fr/v1/works/{$id}", [
            'headers' => [
                'ApiKey' => $_ENV['API_KEY']
            ]
        ]);

        $work = \GuzzleHttp\json_decode($response->getBody());

        return $this->render('work/index.html.twig', [
            'controller_name' => 'WorkController',
            'work' => $work,
            'id' => $id
        ]);
    }
}
