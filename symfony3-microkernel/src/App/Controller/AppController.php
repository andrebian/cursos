<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AppController
 * @package App\Controller
 */
class AppController extends Controller
{
    /**
     * @Route("/")
     */
    public function index()
    {
        return $this->render('index.html.twig', [
            'name' => 'Andre'
        ]);
    }

    /**
     * @Route("/test")
     */
    public function test()
    {
        return new Response('Hello test');
    }
}
