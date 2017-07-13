<?php
/**
 * Created by PhpStorm.
 * User: pancho
 * Date: 7/5/17
 * Time: 2:34 PM
 */

namespace Pizza\Model;

class Pizza
{
    private $name;
    private $dough;
    private $toppings = array();
    private $totalCalories;

    /**
     * Pizza constructor.
     * @param $name
     * @param Dough $dough
     * @param array $topping
     * @throws \Exception
     */

    public function __construct($name, Dough $dough, array $toppings)
    {
        if (empty($name)) {
            throw new \Exception("Please, fill the name.");
        } else {
            $this->name = $name;
        }

        foreach ($toppings as $topping) {

            if ($topping instanceof Topping) { //It's not working with - is_a
                $this->toppings[] = $topping;
            } else {
                throw new \Exception("Incorrect topping data.");
            }

        }

        if (!is_object($dough)) {
            throw new \Exception("Incorrect dough data.");
        } else {
            $this->dough = $dough;
        }

    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Dough
     */
    public function getDough()
    {
        return $this->dough;
    }

    /**
     * @return array
     */
    public function getToppings()
    {
        return $this->toppings;
    }



    /**
     * @return int
     */


    public function totalCalories()
    {
        $calToppings = 0;
        foreach ($this->toppings as $topping) {
            $calToppings += $topping->calcToppingCalories();
        }
        return $this->totalCalories = $this->dough->calcDoughCalories() +  $calToppings;

    }

}