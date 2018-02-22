<?php

namespace App\Factory;

use App\Entity\Combatant;

class CombatantFactory
{
    /**
     * @param string $combatantType
     * @param string $name
     *
     * @return Combatant
     */
    public function create($combatantType, $name) : Combatant
    {
        $combatant = new $combatantType();

        $combatant
            ->setName($name)
            ->setHealth(
                rand(
                    constant(get_class($combatant) . '::HEALTH_MIN'),
                    constant(get_class($combatant) . '::HEALTH_MAX')
                )
            )
            ->setStrength(
                rand(
                    constant(get_class($combatant) . '::STRENGTH_MIN'),
                    constant(get_class($combatant) . '::STRENGTH_MAX')
                )
            )
            ->setDefense(
                rand(
                    constant(get_class($combatant) . '::DEFENSE_MIN'),
                    constant(get_class($combatant) . '::DEFENSE_MAX')
                )
            )
            ->setSpeed(
                rand(
                    constant(get_class($combatant) . '::SPEED_MIN'),
                    constant(get_class($combatant) . '::SPEED_MAX')
                )
            )
            ->setLuck(
                rand(
                    constant(get_class($combatant) . '::LUCK_MIN') * 100,
                    constant(get_class($combatant) . '::LUCK_MAX') * 100
                ) / 100
            );

        return $combatant;
    }
}