<?php

namespace App\Scoring;

use App\Entity\BigFootSighting;

interface ScoringFactorInterface
{
    /**
     * This method should not throw an exception for any normal reason.
     * @param BigFootSighting $sighting
     * @return int
     */
    public function score(BigFootSighting $sighting): int;

}
