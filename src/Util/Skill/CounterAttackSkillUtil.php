<?php

namespace App\Util\Skill;

use App\Entity\Combatant;

class CounterAttackSkillUtil
{
    const DAMAGE = 10;

    /**
     * @param Combatant $combatant
     *
     * @return bool
     */
    public function has(Combatant $combatant) : bool
    {
        return in_array(Combatant::COUNTER_ATTACK_SKILL, $combatant->getSkills());
    }

    /**
     * @param Combatant $attacker
     */
    public function damage(Combatant $attacker)
    {
        $attacker->setHealth($attacker->getHealth() - self::DAMAGE);
    }

    public function canUse(Combatant $combatant) : bool
    {
        return $this->has($combatant);
    }
}