<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220606114817 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activity (id INT AUTO_INCREMENT NOT NULL, user_link_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, departure_time TIME DEFAULT NULL, arrival_time TIME DEFAULT NULL, speed_average DOUBLE PRECISION NOT NULL, speed_max DOUBLE PRECISION NOT NULL, height_difference INT DEFAULT NULL, power_average INT DEFAULT NULL, calories_consumed INT DEFAULT NULL, INDEX IDX_AC74095AF5A91C7B (user_link_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE annual_objective (id INT AUTO_INCREMENT NOT NULL, user_link_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, quantity INT NOT NULL, INDEX IDX_CAFB0319F5A91C7B (user_link_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipment (id INT AUTO_INCREMENT NOT NULL, user_link_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_D338D583F5A91C7B (user_link_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, address VARCHAR(255) NOT NULL, birthday DATETIME NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE activity ADD CONSTRAINT FK_AC74095AF5A91C7B FOREIGN KEY (user_link_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE annual_objective ADD CONSTRAINT FK_CAFB0319F5A91C7B FOREIGN KEY (user_link_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE equipment ADD CONSTRAINT FK_D338D583F5A91C7B FOREIGN KEY (user_link_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activity DROP FOREIGN KEY FK_AC74095AF5A91C7B');
        $this->addSql('ALTER TABLE annual_objective DROP FOREIGN KEY FK_CAFB0319F5A91C7B');
        $this->addSql('ALTER TABLE equipment DROP FOREIGN KEY FK_D338D583F5A91C7B');
        $this->addSql('DROP TABLE activity');
        $this->addSql('DROP TABLE annual_objective');
        $this->addSql('DROP TABLE equipment');
        $this->addSql('DROP TABLE `user`');
    }
}
