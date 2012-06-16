<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema,
    Doctrine\DBAL\Types\Type;

class Version20120616094608 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $schema->getTable('customers')->getColumn('phone')->setType(Type::getType('bigint'));
    }

    public function down(Schema $schema)
    {
        $schema->getTable('customers')->getColumn('phone')->setType(Type::getType('integer'));
    }
}
