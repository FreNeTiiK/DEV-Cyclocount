<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220610074552 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE type_objective (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE annual_objective ADD type_objective_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE annual_objective ADD CONSTRAINT FK_CAFB0319F40BF336 FOREIGN KEY (type_objective_id) REFERENCES type_objective (id)');
        $this->addSql('CREATE INDEX IDX_CAFB0319F40BF336 ON annual_objective (type_objective_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annual_objective DROP FOREIGN KEY FK_CAFB0319F40BF336');
        $this->addSql('DROP TABLE type_objective');
        $this->addSql('DROP INDEX IDX_CAFB0319F40BF336 ON annual_objective');
        $this->addSql('ALTER TABLE annual_objective DROP type_objective_id');
    }
}
