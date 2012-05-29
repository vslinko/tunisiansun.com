<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20120529163951 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $customers = $schema->getTable('customers');

        $orders = $schema->createTable('orders');
        $orders->addColumn('id', 'integer', array('autoincrement' => true));
        $orders->addColumn('customer_id', 'integer');
        $orders->setPrimaryKey(array('id'));
        $orders->addForeignKeyConstraint($customers, array('customer_id'), array('id'));

        $products = $schema->getTable('products');

        $positions = $schema->createTable('positions');
        $positions->addColumn('order_id', 'integer');
        $positions->addColumn('product_id', 'integer');
        $positions->addColumn('count', 'integer');
        $positions->addColumn('price', 'integer');
        $positions->setPrimaryKey(array('order_id', 'product_id'));
        $positions->addForeignKeyConstraint($orders, array('order_id'), array('id'));
        $positions->addForeignKeyConstraint($products, array('product_id'), array('id'));
    }

    public function down(Schema $schema)
    {
        $schema->dropTable('positions');
        $schema->dropTable('orders');
    }
}
