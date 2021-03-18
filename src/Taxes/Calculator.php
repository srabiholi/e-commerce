<?php

namespace App\Taxes;

use Psr\Log\LoggerInterface;

Class Calculator
{

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function calcul(float $prix):float
    {
        $this->logger->info("trop bien sa marche ! un calcul a lieu : $prix");
        return $prix * (20/100);
    }
}

