<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20120529035909 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $schema->getTable('customers')->addColumn('cart', 'text');
    }

    public function down(Schema $schema)
    {
        $schema->getTable('customers')->dropColumn('cart');
    }
}
