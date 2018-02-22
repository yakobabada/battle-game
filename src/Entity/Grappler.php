<?php

namespace App\Entity;

class Grappler extends Combatant
{
    const HEALTH_MIN = 60;
    const HEALTH_MAX = 100;

    const STRENGTH_MIN = 75;
    const STRENGTH_MAX = 80;

    const DEFENSE_MIN = 35;
    const DEFENSE_MAX = 40;

    const SPEED_MIN = 60;
    const SPEED_MAX = 80;

    const LUCK_MIN = 0.3;
    const LUCK_MAX = 0.4;

    /**
     * @return array
     */
    public function getSkills() : array
    {
        return [
            self::COUNTER_ATTACK_SKILL
        ];
    }
}