<?php

namespace App\Service;

use App\Entity\BigFootSighting;
use App\Model\BigFootSightingScore;
use App\Scoring\PhotoFactor;
use App\Scoring\ScoreAdjusterInterface;
use App\Scoring\ScoringFactorInterface;

class SightingScorer
{
    /**
     * @var ScoringFactorInterface[]
     */
    private iterable $scoringFactorInterfaces;

    /**
     * @var ScoreAdjusterInterface[]
     */
    private iterable $scoreAdjusterInterfaces;

    public function __construct(iterable $scoringFactorInterfaces, iterable $scoreAdjusterInterfaces)
    {
        $this->scoringFactorInterfaces = $scoringFactorInterfaces;
        $this->scoreAdjusterInterfaces = $scoreAdjusterInterfaces;
    }

    public function score(BigFootSighting $sighting): BigFootSightingScore
    {
        $score = 0;
        foreach ($this->scoringFactorInterfaces as $scoringFactor) {
            $score += $scoringFactor->score($sighting);
        }

        foreach ($this->scoreAdjusterInterfaces as $scoreAdjust) {
            $score += $scoreAdjust->adjustScore($score, $sighting);
        }
        return new BigFootSightingScore($score);
    }

}
