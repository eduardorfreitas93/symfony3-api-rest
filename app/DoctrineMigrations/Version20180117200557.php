<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180117200557 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE users ADD image_profile INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E91447FDD3 FOREIGN KEY (image_profile) REFERENCES file (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_1483A5E91447FDD3 ON users (image_profile)');
        $this->addSql('ALTER TABLE file DROP CONSTRAINT fk_8c9f36108d93d649');
        $this->addSql('DROP INDEX idx_8c9f36108d93d649');
        $this->addSql('ALTER TABLE file DROP "user"');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE users DROP CONSTRAINT FK_1483A5E91447FDD3');
        $this->addSql('DROP INDEX IDX_1483A5E91447FDD3');
        $this->addSql('ALTER TABLE users DROP image_profile');
        $this->addSql('ALTER TABLE file ADD "user" INT DEFAULT NULL');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT fk_8c9f36108d93d649 FOREIGN KEY ("user") REFERENCES users (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_8c9f36108d93d649 ON file ("user")');
    }
}
