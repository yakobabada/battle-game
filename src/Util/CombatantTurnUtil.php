<?php

namespace App\Util;

use App\Entity\Combatant;

class CombatantTurnUtil
{


    /**
     * @param Combatant $firstCombatant
     * @param Combatant $secondCombatant
     *
     * @return array
     */
    public function getOpponents(Combatant $firstCombatant, Combatant $secondCombatant)
    {
        $attacker = $this->getAttacker($firstCombatant, $secondCombatant);
        $defender = $this->getDefenderByAttacker($attacker, $firstCombatant, $secondCombatant);

        return [
            'attacker' => $attacker,
            'defender' => $defender
        ];
    }

    /**
     * @param Combatant $attacker
     * @param Combatant $defender
     *
     * @return array
     */
    public function getNext(Combatant $attacker, Combatant $defender)
    {
        return $this->swap($attacker, $defender);
    }

    /**
     * @param Combatant $firstCombatant
     * @param $secondCombatant
     *
     * @return Combatant
     *
     * @throws \Exception
     */
    private function getAttacker(Combatant $firstCombatant, Combatant $secondCombatant)
    {
        $faster = $this->getFaster($firstCombatant, $secondCombatant);

        if (null !== $faster) {
            return $faster;
        }

        $leastDefensive = $this->getLeastDefensive($firstCombatant, $secondCombatant);

        if (null !== $leastDefensive) {
            return $leastDefensive;
        }

        throw new \Exception('Game couldn\'t decide who start first, please try again');
    }

    /**
     * @param Combatant $firstCombatant
     * @param Combatant $secondCombatant
     *
     * @return Combatant|null
     */
    private function getFaster(Combatant $firstCombatant, Combatant $secondCombatant)
    {
        if ($firstCombatant->getSpeed() > $secondCombatant->getSpeed()) {
            return $firstCombatant;
        } elseif ($secondCombatant->getSpeed() > $firstCombatant->getSpeed()) {
            return $secondCombatant;
        }

        return null;
    }

    /**
     * @param Combatant $firstCombatant
     * @param Combatant $secondCombatant
     *
     * @return Combatant|null
     */
    private function getLeastDefensive(Combatant $firstCombatant, Combatant $secondCombatant)
    {
        if ($firstCombatant->getDefense() < $secondCombatant->getDefense()) {
            return $firstCombatant;
        } elseif ($secondCombatant->getDefense() < $firstCombatant->getDefense()) {
            return $secondCombatant;
        }

        return null;
    }

    /**
     * @param Combatant $firstCombatant
     * @param Combatant $secondCombatant
     *
     * @return Combatant
     */
    private function getDefenderByAttacker(Combatant $attacker, Combatant $firstCombatant, Combatant $secondCombatant) : Combatant
    {
        if ($attacker === $firstCombatant) {
            return $secondCombatant;
        }

        return $firstCombatant;
    }

    /**
     * @param Combatant $attacker
     * @param Combatant $defender
     *
     * @return array
     */
    private function swap(Combatant $attacker, Combatant $defender)
    {
        return [
            'defender' => $attacker,
            'attacker' => $defender
        ];
    }
}

