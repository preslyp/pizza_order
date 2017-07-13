<?php
/**
 * Created by PhpStorm.
 * User: pancho
 * Date: 7/5/17
 * Time: 11:45 AM
 */

namespace Pizza\Model;

class Topping
{

    private $type;
    private $weight;
    private $types = ['meat' => 3, 'veggies' => 1.6, 'cheese' => 2.2, 'sauce' => 1.8];

    /**
     * Topping constructor.
     * @param $type
     * @param $weight
     * @throws \Exception
     */

    public function __construct($type, $weight)
    {
        if (!empty($type)) {

            if (array_key_exists($type, $this->types)) {

                $this->type = $type;

            } else {

                throw new \Exception("Wrong type data");

            }

        } else {

            throw new \Exception("Please, choose type");

        }

        if ($weight > 0 && $weight <=50) {
            $this->weight = $weight;
        } else {
            throw new \Exception("Wrong weight data");
        }

    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @return mixed
     */

    public function calcToppingCalories()
    {
        return $this->types[$this->type] * $this->weight;
    }

}