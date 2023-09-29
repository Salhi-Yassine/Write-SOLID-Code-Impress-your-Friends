<?php
declare(strict_types=1);

namespace App\Scoring;

use App\Entity\BigFootSighting;

class PhotoFactor implements ScoringFactorInterface, ScoreAdjusterInterface
{

    public function score(BigFootSighting $sighting): int
    {
        $score = 0;
        foreach ($sighting->getImages() as $image) {
            $score += rand(1, 100);
        }
        return $score;
    }

    public function adjustScore(int $finalScore, BigFootSighting $sighting): int
    {
        $countPhoto = count($sighting->getImages());
        if ($countPhoto > 2 && $finalScore < 50) {
            $finalScore += $countPhoto * 5;
        }
        return $finalScore;
    }
}
