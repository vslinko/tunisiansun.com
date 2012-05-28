<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20120528224050 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $customers = $schema->createTable('customers');
        $customers->addColumn('id', 'integer', array('autoincrement' => true));
        $customers->addColumn('email', 'string', array('length' => 255));
        $customers->addColumn('phone', 'integer');
        $customers->addColumn('name', 'string', array('length' => 255));
        $customers->addColumn('password', 'string', array('length' => 255));
        $customers->addColumn('salt', 'string', array('length' => 32));
        $customers->addColumn('is_admin', 'boolean');
        $customers->setPrimaryKey(array('id'));
        $customers->addUniqueIndex(array('email'));
        $customers->addUniqueIndex(array('phone'));
    }

    public function down(Schema $schema)
    {
        $schema->dropTable('customers');
    }
}
