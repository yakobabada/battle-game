<?php

namespace App\Util;

use App\Entity\Combatant;
use App\Util\Skill\CounterAttackSkillUtil;

class BattleUtil
{
    /**
     * @var LuckUtil
     */
    private $luckUtil;

    /**
     * @var CounterAttackSkillUtil
     */
    private $counterAttackSkillUtil;

    public function __construct(LuckUtil $luckUtil, CounterAttackSkillUtil $counterAttackSkillUtil)
    {
        $this->luckUtil = $luckUtil;
        $this->counterAttackSkillUtil = $counterAttackSkillUtil;
    }

    /**
     * @param Combatant $attacker
     * @param Combatant $defender
     */
    public function attack(Combatant $attacker, Combatant $defender)
    {
        if ($this->canEvade($defender)) {
            $this->useCounterAttack($defender, $attacker);
        } else {
            $damage = $this->calculateDamage($attacker->getStrength(), $defender->getDefense());
            $this->damageDefender($defender, $damage);
        }
    }

    /**
     * @param int $attackerStrength
     * @param int $defenderDefense
     *
     * @return int
     */
    private function calculateDamage(int $attackerStrength, int $defenderDefense) : int
    {
        return $attackerStrength - $defenderDefense;
    }

    /**
     * @param Combatant $defender
     * @param int $damage
     */
    private function damageDefender(Combatant $defender, int $damage)
    {
        $defender->setHealth($defender->getHealth() - $damage);
    }

    /**
     * @param Combatant $defender
     *
     * @return bool
     */
    private function canEvade(Combatant $defender) : bool
    {
        return $this->luckUtil->check($defender->getLuck() * 100);
    }

    /**
     * @param Combatant $defender
     * @param Combatant $attacker
     */
    private function useCounterAttack(Combatant $defender, Combatant $attacker)
    {
        if ($this->counterAttackSkillUtil->has($defender)) {
            $this->counterAttackSkillUtil->damage($attacker);
        }

        return null;
    }
}

