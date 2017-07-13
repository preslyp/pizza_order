<?php

use Phinx\Seed\AbstractSeed;

class AllSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {

        $dataBaking = array(

            array(
                'baking_name' => 'crispy'
            ),
            array(
                'baking_name' => 'chewy'
            ),
            array(
                'baking_name' => 'homemade'
            )
        );

        $table = $this->table('baking');
        $table->insert($dataBaking)->save();

        $dataFlour = array(

            array(
                'flour_name' => 'white'
            ),
            array(
                'flour_name' => 'wholegrain'
            )
        );

        $table = $this->table('flour');
        $table->insert($dataFlour)->save();


        $dataTopping = array(

            array(
                'topping_name' => 'meat'
            ),
            array(
                'topping_name' => 'veggies'
            ),
            array(
                'topping_name' => 'cheese'
            ),
            array(
                'topping_name' => 'sauce'
            )
        );

        $table = $this->table('topping');
        $table->insert($dataTopping)->save();

    }
}
