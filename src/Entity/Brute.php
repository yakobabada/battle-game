<?php

namespace App\Entity;

class Brute extends Combatant
{
    const HEALTH_MIN = 90;
    const HEALTH_MAX = 100;

    const STRENGTH_MIN = 65;
    const STRENGTH_MAX = 75;

    const DEFENSE_MIN = 40;
    const DEFENSE_MAX = 50;

    const SPEED_MIN = 40;
    const SPEED_MAX = 65;

    const LUCK_MIN = 0.3;
    const LUCK_MAX = 0.35;

    /**
     * @return array
     */
    public function getSkills() : array
    {
        return [
            self::STUNNING_BLOW_SKILL
        ];
    }
}