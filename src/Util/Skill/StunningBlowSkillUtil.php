<?php

namespace App\Util\Skill;

use App\Entity\Combatant;
use App\Util\LuckUtil;

class StunningBlowSkillUtil
{
    const CHANCE = 2;

    /**
     * @var LuckUtil
     */
    private $luckUtil;

    public function __construct(LuckUtil $luckUtil)
    {

        $this->luckUtil = $luckUtil;
    }

    /**
     * @param Combatant $combatant
     *
     * @return bool
     */
    public function has(Combatant $combatant) : bool
    {
        return in_array(Combatant::STUNNING_BLOW_SKILL, $combatant->getSkills());
    }

    /**
     * @param Combatant $combatant
     *
     * @return bool
     */
    public function canUse(Combatant $combatant) : bool
    {
        return $this->has($combatant) && $this->luckUtil->check(self::CHANCE);
    }
}