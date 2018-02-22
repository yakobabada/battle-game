<?php

namespace App\Util;

use App\Entity\Combatant;
use App\Util\Skill\CounterAttackSkillUtil;
use App\Util\Skill\LuckyStrikeSkillUtil;
use App\Util\Skill\StunningBlowSkillUtil;

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

    /**
     * @var LuckyStrikeSkillUtil
     */
    private $luckyStrikeSkillUtil;

    /**
     * @var StunningBlowSkillUtil
     */
    private $blowSkillUtil;

    /**
     * BattleUtil constructor.
     *
     * @param LuckUtil $luckUtil
     * @param CounterAttackSkillUtil $counterAttackSkillUtil
     * @param LuckyStrikeSkillUtil $luckyStrikeSkillUtil
     * @param StunningBlowSkillUtil $blowSkillUtil
     */
    public function __construct(
        LuckUtil $luckUtil,
        CounterAttackSkillUtil $counterAttackSkillUtil,
        LuckyStrikeSkillUtil $luckyStrikeSkillUtil,
        StunningBlowSkillUtil $blowSkillUtil
    ) {
        $this->luckUtil = $luckUtil;
        $this->counterAttackSkillUtil = $counterAttackSkillUtil;
        $this->luckyStrikeSkillUtil = $luckyStrikeSkillUtil;
        $this->blowSkillUtil = $blowSkillUtil;
    }

    /**
     * @param Combatant $attacker
     * @param Combatant $defender
     */
    public function play(Combatant $attacker, Combatant $defender)
    {
        if ($this->canEvade($defender)) {
            $this->evade($attacker, $defender);

        } else {
            $this->attack($attacker, $defender);
        }
    }

    /**
     * @param Combatant $attacker
     *
     * @return bool
     */
    public function stopSwap(Combatant $attacker) : bool
    {
        return $this->blowSkillUtil->canUse($attacker);
    }

    /**
     * @param Combatant $attacker
     * @param Combatant $defender
     */
    private function evade(Combatant $attacker, Combatant $defender)
    {
        if ($this->counterAttackSkillUtil->CanUse($defender)) {
            $this->counterAttackSkillUtil->damage($attacker);
        }
    }

    private function attack(Combatant $attacker, Combatant $defender)
    {
        if ($this->luckyStrikeSkillUtil->canUse($attacker)) {
            $this->luckyStrikeSkillUtil->damage($attacker, $defender);
        } else {
            $this->damageDefender($attacker, $defender);
        }
    }

    /**
     * @param Combatant $attacker
     * @param Combatant $defender
     */
    private function damageDefender(Combatant $attacker, Combatant $defender)
    {
        $damage = $attacker->getStrength() - $defender->getDefense();
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
}

