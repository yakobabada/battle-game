<?php

namespace App\Util;

class LuckUtil
{
    /**
     * @param int $chance should be between 0 and 100
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function check(int $chance) : bool
    {
        if ($chance < 0 || $chance > 100) {
            throw new \Exception('The chance should be between 0 and 100');
        }

        if (rand(0, 100) < $chance) {
            return true;
        }

        return false;
    }
}