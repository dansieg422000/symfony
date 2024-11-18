<?php

namespace App\Controller;

use App\Repository\GlossRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/')]
    public function homepage(GlossRepository $repo): Response
    {
        $features = $repo->findAll();

        return $this->render('main/homepage.html.twig', [
            'features' => $features,
        ]);
    }
}