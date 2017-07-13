<?php

namespace Pizza\Controller;

session_start();

use Pizza\Model\Dough;
use Pizza\Model\ProductDAO;
use Pizza\Model\Pizza;
use Pizza\Model\PizzaDAO;
use Pizza\Model\Topping;


class HomeController extends MainController
{

    public function index()
    {
        $data['title'] = 'Order your pizza';

        if (isset($_SESSION['errors'])) {
            $data['errors'] = $_SESSION['errors'];
            unset($_SESSION['errors']);
        } else {
            $data['errors'] = "";
        }

        $products = new ProductDAO();
        $data['baking'] = $products->getBakingData();
        $data['flourtype'] = $products->getFlourData();
        $data['topping'] = $products->getToppingData();

        echo $this->template->render('homepage.twig', $data);

    }

    public function addProduct()
    {
        $postData = $this->request->request->all();


        try {

            $name = (isset($postData['pizzaname'])) ? check_input($postData['pizzaname']) : '';
            $flourtype = (isset($postData['flourtype'])) ? check_input($postData['flourtype']) : '';
            $bakingtechnique = (isset($postData['bakingtechnique'])) ? check_input($postData['bakingtechnique']) : '';
            $dough = new Dough($flourtype, $bakingtechnique);

            $toppings = [];
            for ($i = 0; $i < count($postData['topping']), $i < count($postData['weight_topping']); $i++) {
                $toppings[] = new Topping($postData['topping'][$i], $postData['weight_topping'][$i]);
            }

            $pizza = new Pizza($name, $dough, $toppings);
            $insert = new ProductDAO();
            $insert->persist($pizza);

            redirect("/pizza_final/index.php/all");

        } catch (\Exception $e) {

            $_SESSION['errors'] = "Message: " . $e->getMessage();
            redirect("/pizza_final/index.php");

        }

    }

}




