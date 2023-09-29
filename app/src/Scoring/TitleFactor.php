<?php
declare(strict_types=1);

namespace App\Scoring;

use App\Entity\BigFootSighting;

class TitleFactor implements ScoringFactorInterface
{

    public function score(BigFootSighting $sighting): int
    {
        $score = 0;
        $title = strtolower($sighting->getTitle());

        if (stripos($title, 'hairy') !== false) {
            $score += 10;
        }

        if (stripos($title, 'chased me') !== false) {
            $score += 20;
        }

        return $score;
    }

}
