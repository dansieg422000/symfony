<?php

namespace App\Repository;

use App\Model\Gloss;
use Psr\Log\LoggerInterface;

class GlossRepository
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    public function findAll(): array
    {
        $this->logger->info('From GlossRepo');

        return [
            new Gloss(1, 'Stripe'),
            new Gloss(2, 'Basiq'),
            new Gloss(3, 'Plaid'),
        ];
    }

    public function find(int $id): ?Gloss
    {
        foreach ($this->findAll() as $item) {
            if ($item->getId() === $id) {
                return $item;
            }
        }

        return null;
    }
}
