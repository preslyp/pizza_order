<?php
/**
 * Created by PhpStorm.
 * User: pancho
 * Date: 7/5/17
 * Time: 4:20 PM
 */

namespace Pizza\Model;


class ProductDAO extends AbstractDBquery
{
    private $pizza;

    /**
     * @return array
     */

    public function getBakingData()
    {
        try {
            return($this->fetchAll("SELECT baking_name FROM baking"));
        } catch (\PDOException $e) {
            echo 'Message: ' . $e->getMessage();
        }

    }


    /**
     * @return array
     */

    public function getFlourData()
    {
        try {
            return($this->fetchAll("SELECT flour_name FROM flour"));
        } catch (\PDOException $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    /**
     * @return array
     */

    public function getToppingData()
    {
        try {
            return($this->fetchAll("SELECT * FROM topping"));
        } catch (\PDOException $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    /**
     * @param $name
     * @return array
     */

    private function getIdTopping($name)
    {
        try {
            $sql = 'SELECT id FROM topping WHERE topping_name = :name';
            $bindParams = [
                'name' => $name,
            ];
            $res = $this->fetch($sql, $bindParams);
            return array_shift($res);
        } catch (\PDOException $e) {
            echo 'Message: ' . $e->getMessage();
        }

    }

    /**
     * @param $name
     * @return array
     */

    private function getIdBaking($name)
    {
        try {
            $sql = 'SELECT id FROM baking WHERE baking_name = :name';
            $bindParams = [
                'name' => $name,
            ];
            $res = $this->fetch($sql, $bindParams);
            return array_shift($res);
        } catch (\PDOException $e) {
            echo 'Message: ' . $e->getMessage();
        }

    }

    /**
     * @param $name
     * @return integer
     */

    private function getIdFlour($name)
    {
        try {
            $sql = 'SELECT id FROM flour WHERE flour_name = :name';
            $bindParams = [
                'name' => $name,
            ];
            $res =$this->fetch($sql, $bindParams);
            return array_shift($res);
        } catch (\PDOException $e) {
            echo 'Message: ' . $e->getMessage();
        }

    }

    public function getDataFromPizzaToppingTable($id)
    {
        try {

            $sql = "SELECT t.topping_name, pt.weight FROM pizza_all p JOIN pizza_topping pt 
                    ON (p.id = pt.pizza_id) JOIN topping t 
                    ON (pt.topping_id = t.id) WHERE p.id = :id";


            $bindParams = [
                'id' => $id,
            ];

            $res = $this->fetchAllParams($sql, $bindParams);
            return $res;


        } catch (\PDOException $e) {

            echo 'Message: ' . $e->getMessage();

        }

    }


    //PIZZA DATA

    private function insertDataPizza($pizzaName, $flour, $baking)
    {
        try {

            $sql = "INSERT INTO pizza_all (pizza_name, flour_id, baking_id)
                    VALUES (:pizza_name, :flour_id, :baking_id)";

            $bindParams = [
                'pizza_name'        => $pizzaName,
                'flour_id'          => $flour,
                'baking_id'         => $baking
            ];

            return ($this->exec($sql, $bindParams));

        } catch (\PDOException $e) {

            echo 'Message: ' . $e->getMessage();

        }
    }


    private function insertDataTopping($pizzaId, $toppingId, $weight)
    {
        try {

            $sql = "INSERT INTO pizza_topping (pizza_id, topping_id, weight) VALUES (:pizza_id, :topping_id, :weight )";

            $bindParams = [
                'pizza_id'      => $pizzaId,
                'topping_id'    => $toppingId,
                'weight'        => $weight
            ];

            return ($this->exec($sql, $bindParams));

        } catch (\PDOException $e) {

            echo 'Message: ' . $e->getMessage();

        }
    }

    public function getIdPizza($name)
    {
        try {
            $sql = 'SELECT id FROM pizza_all WHERE pizza_name = :name';
            $bindParams = [
                'name' => $name,
            ];
            $res = $this->fetch($sql, $bindParams);
            return array_shift($res);
        } catch (\PDOException $e) {
            echo 'Message: ' . $e->getMessage();
        }

    }

    public function persist(Pizza $pizza) {

        try {
            $this->pizza = $pizza;

            $name = $this->pizza->getName();
            $flourId = $this->getIdFlour($this->pizza->getDough()->getFlour());
            $bakingId = $this->getIdBaking($pizza->getDough()->getBaking());

            $this->insertDataPizza($name, $flourId, $bakingId);

            $pizzaId = $this->getIdPizza($name);

            $toppings = [];
            foreach ($this->pizza->getToppings() as $topping) {
                $toppings[] = $topping->getType();
            }

            $toppingsId = [];
            foreach ($toppings as $value) {
                $toppingsId[] = $this->getIdTopping($value);
            }

            $weights = [];
            foreach ($this->pizza->getToppings() as $topping) {
                $weights[] = $topping->getWeight();
            }


            for ($i = 0; $i < count($toppingsId), $i < count($weights); $i++) {

               $this->insertDataTopping($pizzaId, $toppingsId[$i], $weights[$i]);

            }
        }catch (\Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }


    }

    public function getPizzaData()
    {
        try {

            $row = $this->fetchAll("SELECT pa.pizza_name, f.flour_name, b.baking_name 
                                        FROM pizza_all pa JOIN flour f ON (pa.flour_id = f.id) 
                                        JOIN baking b ON (pa.baking_id = b.id)");

            return $row;

        } catch (\PDOException $e) {

            echo 'Message: ' . $e->getMessage();

        }

    }




}