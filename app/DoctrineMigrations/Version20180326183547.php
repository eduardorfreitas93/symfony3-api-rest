<?php declare(strict_types = 1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180326183547 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE tatic_rel DROP CONSTRAINT fk_26dc903ebf396750');
        $this->addSql('ALTER TABLE tatic_rel ADD tatic_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tatic_rel ADD CONSTRAINT FK_26DC903ED4FB1976 FOREIGN KEY (tatic_id) REFERENCES tatic (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_26DC903ED4FB1976 ON tatic_rel (tatic_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE tatic_rel DROP CONSTRAINT FK_26DC903ED4FB1976');
        $this->addSql('DROP INDEX IDX_26DC903ED4FB1976');
        $this->addSql('ALTER TABLE tatic_rel DROP tatic_id');
        $this->addSql('ALTER TABLE tatic_rel ADD CONSTRAINT fk_26dc903ebf396750 FOREIGN KEY (id) REFERENCES tatic (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
