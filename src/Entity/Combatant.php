<?php

namespace App\Entity;

abstract class Combatant
{
    const TYPES = [
        'App\Entity\Brute',
        'App\Entity\Grappler',
        'App\Entity\Swordsman'
    ];

    const LUCKY_STRIKE_SKILL = 'lucky_strike';
    const STUNNING_BLOW_SKILL = 'stunning_blow';
    const COUNTER_ATTACK_SKILL = 'counter_attack';

    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $health;

    /**
     * @var int
     */
    protected $strength;

    /**
     * @var int
     */
    protected $defense;

    /**
     * @var int
     */
    protected $speed;

    /**
     * @var float
     */
    protected $luck;


    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Combatant
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int
     */
    public function getHealth() : int
    {
        return $this->health;
    }

    /**
     * @param int $health
     *
     * @return Combatant
     */
    public function setHealth(int $health)
    {
        $this->health = $health;

        return $this;
    }

    /**
     * @return int
     */
    public function getStrength() : int
    {
        return $this->strength;
    }

    /**
     * @param int $strength
     *
     * @return Combatant
     */
    public function setStrength(int $strength)
    {
        $this->strength = $strength;

        return $this;
    }

    /**
     * @return int
     */
    public function getDefense()
    {
        return $this->defense;
    }

    /**
     * @param int $defense
     *
     * @return Combatant
     */
    public function setDefense(int $defense)
    {
        $this->defense = $defense;

        return $this;
    }

    /**
     * @return int
     */
    public function getSpeed() : int
    {
        return $this->speed;
    }

    /**
     * @param int $speed
     * @return Combatant
     */
    public function setSpeed(int $speed)
    {
        $this->speed = $speed;

        return $this;
    }

    /**
     * @return float
     */
    public function getLuck() : float
    {
        return $this->luck;
    }

    /**
     * @param float $luck
     * @return Combatant
     */
    public function setLuck(float $luck)
    {
        $this->luck = $luck;

        return $this;
    }

    /**
     * @return bool
     */
    public function isAlive() : bool
    {
        return $this->health > 0;
    }

    public abstract function getSkills();
}