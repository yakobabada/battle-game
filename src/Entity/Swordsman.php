<?php

namespace App\Entity;

class Swordsman extends Combatant
{
    const HEALTH_MIN = 40;
    const HEALTH_MAX = 60;

    const STRENGTH_MIN = 60;
    const STRENGTH_MAX = 70;

    const DEFENSE_MIN = 20;
    const DEFENSE_MAX = 30;

    const SPEED_MIN = 90;
    const SPEED_MAX = 100;

    const LUCK_MIN = 0.3;
    const LUCK_MAX = 0.5;

    /**
     * @return array
     */
    public function getSkills() : array
    {
        return [
            self::LUCKY_STRIKE_SKILL
        ];
    }
}