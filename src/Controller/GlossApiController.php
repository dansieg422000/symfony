<?php

namespace App\Controller;

use App\Repository\GlossRepository;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/gloss')]
class GlossApiController extends AbstractController
{
    public function __construct(private GlossRepository $glossRepo)
    {
    }

    #[Route('', methods: ['GET'])]
    public function getCollection(LoggerInterface $logger): Response
    {
        $logger->info('Gloss Endpoint');

        $payment = $this->glossRepo->findAll();
        return $this->json($payment);
    }

    #[Route('/{id<\d+>}', methods: ['GET'])]
    public function get(int $id): Response
    {
        $gloss = $this->glossRepo->find($id);

        if (!$gloss) {
            throw $this->createNotFoundException('Gloss not found');
        }

        return $this->json($gloss);
    }
}
