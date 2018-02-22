<?php

namespace App\Util;

use App\Entity\Combatant;

class CombatantTurnUtil
{
    /**
     * @var Combatant
     */
    private $attacker;

    /**
     * @var Combatant
     */
    private $defender;

    /**
     * @param Combatant $attacker
     */
    public function setAttacker(Combatant $attacker)
    {
        $this->attacker = $attacker;
    }

    /**
     * @return Combatant
     *
     * @throws \Exception
     */
    public function getAttacker() : Combatant
    {
        if (null === $this->attacker) {
            throw new \Exception('Attacker hasn\'t chosen yet');
        }

        return $this->attacker;
    }

    /**
     * @param Combatant $defender
     */
    public function setDefender(Combatant $defender)
    {
        $this->defender = $defender;
    }

    /**
     * @return Combatant
     *
     * @throws \Exception
     */
    public function getDefender() : Combatant
    {
        if (null === $this->defender) {
            throw new \Exception('Defender hasn\'t chosen yet');
        }

        return $this->defender;
    }

    /**
     * @param Combatant $firstCombatant
     * @param Combatant $secondCombatant
     */
    public function chooseOpponents(Combatant $firstCombatant, Combatant $secondCombatant)
    {
        $this->setAttacker($this->ChooseAttacker($firstCombatant, $secondCombatant));
        $this->setDefender($this->determineDefender($firstCombatant, $secondCombatant));
    }

    public function chooseNext()
    {
        $this->swap();
    }

    /**
     * @param Combatant $firstCombatant
     * @param $secondCombatant
     *
     * @return Combatant
     *
     * @throws \Exception
     */
    private function ChooseAttacker(Combatant $firstCombatant, Combatant $secondCombatant)
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
    private function determineDefender(Combatant $firstCombatant, Combatant $secondCombatant) : Combatant
    {
        if ($this->getAttacker() === $firstCombatant) {
            return $secondCombatant;
        }

        return $firstCombatant;
    }

    private function swap()
    {
        $attacker = $this->getAttacker();

        $this->setAttacker($this->getDefender());
        $this->setDefender($attacker);
    }
}

