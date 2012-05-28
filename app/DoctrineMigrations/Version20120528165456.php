<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20120528165456 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $schema->getTable('products')->addColumn('photo', 'string', array('length' => 255, 'notnull' => false));
    }

    public function down(Schema $schema)
    {
        $schema->getTable('products')->dropColumn('photo');
    }
}
