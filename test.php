<?php

use Pizza\Model\AbstractDBquery;
use Pizza\Model\DBConnection;

require __DIR__.'/vendor/autoload.php';
require_once "Helper/functions.php";


class TestOne
{

    const ALL = "SELECT p.pizza_name, f.flour_name, b.baking_name, t.topping_name, tt.topping_name, ttt.topping_name FROM pizza_all p JOIN flour f ON(p.flour_id = f.id) JOIN baking b ON( p.baking_id = b.id) JOIN topping t on (p.topping_one = t.id) JOIN topping tt on (p.topping_two = tt.id) JOIN topping ttt on (p.topping_three = ttt.id)
";

    private $db;

    public function __construct()
    {
        try {

            $this->db = DBConnection::getDb();

        } catch (\Exception $e) {

            echo 'Message: ' . $e->getMessage();

        }

    }

    public function fetchAll()
    {
        try {

            $pstmt = $this->db->query(self::ALL);
            $rows = $pstmt->fetchAll(\PDO::FETCH_ASSOC);

            return $rows;

        } catch ( \PDOException $e ) {

            throw new \PDOException ( "Something went wrong, please try again later!" );
        }

    }


}

$test = new TestOne();

var_dump($test->fetchAll());

