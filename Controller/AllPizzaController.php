<?php
/**
 * Created by PhpStorm.
 * User: pancho
 * Date: 7/4/17
 * Time: 5:16 PM
 */

namespace Pizza\Controller;

session_start();

use Pizza\Model\Dough;
use Pizza\Model\Pizza;
use Pizza\Model\PizzaDAO;
use Pizza\Model\ProductDAO;
use Pizza\Model\Topping;

class AllPizzaController extends MainController
{

     function index() {

        if (isset($_SESSION['errors'])) {
            $data['errors'] = $_SESSION['errors'];
            unset($_SESSION['errors']);
        } else {
            $data['errors'] = "";
        }

        $data['title'] = 'Pizza and calories';
        $pizza = new ProductDAO();
        $pizza_all = $pizza->getPizzaData();
        $data['pizza'] = $pizza_all;
        $showCall = new ProductDAO();


        foreach ($data['pizza'] as $pizza)
        {

            try{

                $pizzaId = new ProductDAO();
                $id = $pizzaId->getIdPizza($pizza['pizza_name']);

                $topping = new ProductDAO();
                $data['topping'] = $topping->getDataFromPizzaToppingTable($id);

                $toppings = [];
                $weights = [];
                foreach ( $data['topping'] as $topping) {
                   $toppings[] = $topping['topping_name'];
                   $weights [] = $topping['weight'];
                }

                $toppingsObj = [];
                for ($i = 0; $i<count($toppings), $i< count($weights); $i++) {
                    $toppingsObj[] = new Topping($toppings[$i], $weights[$i]);
                }

                $dough = new Dough($pizza['flour_name'], $pizza['baking_name']);
                $pizza = new Pizza($pizza['pizza_name'], $dough, $toppingsObj );

            } catch (\Exception $e) {
                $_SESSION['errors'] = "Message: " . $e->getMessage();
                redirect("/pizza_final/index.php");
            }

            $data['calories'][] = $pizza->totalCalories();

        }


        echo $this->template->render('all.twig', $data);
    }
}