<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_home', methods: ['GET','POST'])]
    public function home()
    {
        return $this->render('main/home.html.twig');
    }

    #[Route('/test', name: 'app_test', methods: ['GET','POST'])]
    public function test()
    {
        $phraseChatanique = "Tremblez humains !";

        $nourritureChatanique = [
            "croquettes",
            "friandises félines",
            "tout ce qui traine"
        ];
        $bookChatanique = [
        "title"=> "Ma vie, mon oeuvre",
        "author" => "Chatan",
        "year" => 2024
        ];

        return $this->render('main/test.html.twig', [
            "phraseChatanique" => $phraseChatanique,
            "nourritureChatanique" => $nourritureChatanique,
            "bookChatanique" => $bookChatanique
        ]);
    }
    #[Route('/aboutUs', name: 'app_infos', methods: ['GET', 'POST'])]
    public function infos()
    {
        return $this->render('main/infos.html.twig');
    }
}