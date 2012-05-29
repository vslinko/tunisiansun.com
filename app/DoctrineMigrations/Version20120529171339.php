<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20120529171339 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $schema->getTable('customers')->getColumn('cart')->setNotnull(false);
    }

    public function down(Schema $schema)
    {
        $schema->getTable('customers')->getColumn('cart')->setNotnull(true);
    }
}
