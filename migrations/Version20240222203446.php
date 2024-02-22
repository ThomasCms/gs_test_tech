<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240222203446 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create Band table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE band (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, start_year SMALLINT NOT NULL, end_year SMALLINT DEFAULT NULL, founders VARCHAR(255) DEFAULT NULL, members INT DEFAULT NULL, music_style VARCHAR(255) DEFAULT NULL, details LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_48DFA2EB5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE band');
    }
}
