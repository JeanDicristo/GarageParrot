<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230704202314 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE photo_id_seq CASCADE');
        $this->addSql('ALTER TABLE photo DROP CONSTRAINT fk_14b78418c3c6f69f');
        $this->addSql('DROP TABLE photo');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE photo_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE photo (id INT NOT NULL, car_id INT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, image_name VARCHAR(255) DEFAULT NULL, image_size INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_14b78418c3c6f69f ON photo (car_id)');
        $this->addSql('COMMENT ON COLUMN photo.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN photo.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT fk_14b78418c3c6f69f FOREIGN KEY (car_id) REFERENCES car (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
