<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20120529175714 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $schema->getTable('customers')->dropColumn('cart');
    }

    public function down(Schema $schema)
    {
        $schema->getTable('customers')->addColumn('cart', 'text');
    }
}
