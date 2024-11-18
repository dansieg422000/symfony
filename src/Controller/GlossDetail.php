<?php

namespace App\Controller;

use App\Repository\GlossRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GlossDetail extends AbstractController
{
    #[Route('/gloss/{id<\d+>}', name: 'app_glossdetail_show', methods: ['GET'])]
    public function show(int $id, GlossRepository $repo): Response
    {
        $gloss = $repo->find($id);

        if (!$gloss) {
            throw $this->createNotFoundException('Gloss detail not found');
        }

        return $this->render('/gloss/gloss-detail.twig', [
            'gloss' => $gloss,
        ]);
    }
}
