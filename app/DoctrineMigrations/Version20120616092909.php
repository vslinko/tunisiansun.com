<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20120616092909 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $schema->getTable('products')->getColumn('brand_id')->setNotnull(false);
    }

    public function down(Schema $schema)
    {
        $schema->getTable('products')->getColumn('brand_id')->setNotnull(true);
    }
}
