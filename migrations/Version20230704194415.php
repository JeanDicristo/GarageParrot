<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230704194415 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE photo ADD car_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE photo ADD image_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE photo ADD image_size INT DEFAULT NULL');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B78418C3C6F69F FOREIGN KEY (car_id) REFERENCES car (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_14B78418C3C6F69F ON photo (car_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE photo DROP CONSTRAINT FK_14B78418C3C6F69F');
        $this->addSql('DROP INDEX IDX_14B78418C3C6F69F');
        $this->addSql('ALTER TABLE photo DROP car_id');
        $this->addSql('ALTER TABLE photo DROP image_name');
        $this->addSql('ALTER TABLE photo DROP image_size');
    }
}
