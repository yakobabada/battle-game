<?php

namespace App\Util\Skill;

use App\Entity\Combatant;

class CounterAttackSkillUtil
{
    const DAMAGE = 10;
    /**
     * @param Combatant $combatant
     *
     * @return boo
     */
    public function has(Combatant $combatant) : boo
    {
        in_array(Combatant::COUNTER_ATTACK_SKILL, $combatant->getSkills());
    }

    /**
     * @param Combatant $combatant
     */
    public function damage(Combatant $attacker)
    {
        $attacker->setHealth($attacker->getHealth() - self::DAMAGE);
    }
}