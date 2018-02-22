<?php

namespace App\Util\Skill;

use App\Entity\Combatant;
use App\Util\LuckUtil;

class LuckyStrikeSkillUtil
{
    const CHANCE = 5;

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
        return in_array(Combatant::LUCKY_STRIKE_SKILL, $combatant->getSkills());
    }

    /**
     * @param Combatant $attacker
     * @param Combatant $defender
     */
    public function damage(Combatant $attacker, Combatant $defender)
    {
        $damage = $attacker->getStrength() * 2 - $defender->getDefense();
        $defender->setHealth($defender->getHealth() - $damage);
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