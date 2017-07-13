<?php

use Phinx\Migration\AbstractMigration;

class CreateDataBaseTables extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {

        $table = $this->table('flour');
        $table  ->addColumn('flour_name', 'string', array('limit' => 10))
                ->create();


        $table = $this->table('baking');
        $table  ->addColumn('baking_name', 'string', array('limit' => 10))
                ->create();


        $table = $this->table('topping');
        $table  ->addColumn('topping_name', 'string', array('limit' => 10))
                ->create();

        $table = $this->table('pizza_all');
        $table  -> addColumn('pizza_name', 'string', ['limit' => 45, 'null' => false])
                -> addColumn('flour_id', 'integer', ['after' => 'pizza_name', 'null' => false])
                -> addColumn('baking_id', 'integer', ['after' => 'flour_id', 'null' => false]);

        $table->addForeignKey('flour_id', 'flour', 'id');
        $table->addForeignKey('baking_id', 'baking', 'id');
        $table->create();


        $table = $this->table('pizza_topping');
        $table ->  addColumn('pizza_id', 'integer', ['null' => false])
               ->  addColumn('topping_id', 'integer', ['null' => false])
               ->  addColumn('weight', 'float', ['null' => false]);

        $table->addForeignKey('pizza_id', 'pizza_all', 'id');
        $table->addForeignKey('topping_id', 'topping', 'id')
               ->create();




    }
}
