<?php
/**
 * Created by PhpStorm.
 * User: pancho
 * Date: 7/5/17
 * Time: 12:17 PM
 */

namespace Pizza\Model;


class Dough
{
    private $flour;
    private $baking;
    private $flourTypes = ['white'=> 1.5, 'wholegrain' => 1.0];
    private $bakingTechniques = ['crispy'=> 0.9, 'chewy' => 1.1, 'homemade' => 1.0];
    const DOUGH_WЕIGHT = 400;

    /**
     * Dough constructor.
     * @param $flour
     * @param $baking
     * @throws \Exception
     */

    public function __construct($flour, $baking)
    {
        if (!empty($flour)) {
            $this->flour = $flour;
        } else {
            throw new \Exception("Please choose flour");
        }

        if (!empty($baking)) {
            $this->baking = $baking;
        } else {
            throw new \Exception("Please choose baking");
        }

    }

    /**
     * @return mixed
     */
    public function getFlour()
    {
        return $this->flour;
    }

    /**
     * @return mixed
     */
    public function getBaking()
    {
        return $this->baking;
    }

    /**
     * @return int
     */

    public function calcDoughCalories()
    {
        return (2 * self::DOUGH_WЕIGHT) * $this->flourTypes[ $this->flour] * $this->bakingTechniques[$this->baking];
    }


}