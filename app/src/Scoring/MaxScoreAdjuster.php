<?php
declare(strict_types=1);

namespace App\Scoring;

use App\Entity\BigFootSighting;

class MaxScoreAdjuster implements ScoreAdjusterInterface
{
    public function adjustScore(int $finalScore, BigFootSighting $sighting): int
    {
        return min(100, $finalScore);
    }
}
