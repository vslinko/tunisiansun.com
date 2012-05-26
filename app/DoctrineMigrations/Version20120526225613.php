<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20120526225613 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $brands = $schema->createTable('brands');
        $brands->addColumn('id', 'integer');
        $brands->addColumn('name', 'string', array('length' => 255));
        $brands->addColumn('slug', 'string', array('length' => 255));
        $brands->setPrimaryKey(array('id'));
        $brands->addUniqueIndex(array('slug'));

        $categories = $schema->createTable('categories');
        $categories->addColumn('id', 'integer');
        $categories->addColumn('name', 'string', array('length' => 255));
        $categories->addColumn('slug', 'string', array('length' => 255));
        $categories->setPrimaryKey(array('id'));
        $categories->addUniqueIndex(array('slug'));

        $products = $schema->createTable('products');
        $products->addColumn('id', 'integer');
        $products->addColumn('name', 'string', array('length' => 255));
        $products->addColumn('slug', 'string', array('length' => 255));
        $products->addColumn('price', 'integer');
        $products->addColumn('description', 'text');
        $products->addColumn('category_id', 'integer');
        $products->addColumn('brand_id', 'integer');
        $products->setPrimaryKey(array('id'));
        $products->addUniqueIndex(array('slug'));
        $products->addForeignKeyConstraint($categories, array('category_id'), array('id'));
        $products->addForeignKeyConstraint($brands, array('brand_id'), array('id'));
    }

    public function down(Schema $schema)
    {
        $schema->dropTable('products');
        $schema->dropTable('categories');
        $schema->dropTable('brands');
    }
}
