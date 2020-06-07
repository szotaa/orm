<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200328083016 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE powiaty (id INT AUTO_INCREMENT NOT NULL, nazwa VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE miasta ADD powiat_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE miasta ADD CONSTRAINT FK_35410348C05AA04F FOREIGN KEY (powiat_id) REFERENCES powiaty (id)');
        $this->addSql('CREATE INDEX IDX_35410348C05AA04F ON miasta (powiat_id)');
        $this->addSql('ALTER TABLE nieruchomosci DROP opis');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE miasta DROP FOREIGN KEY FK_35410348C05AA04F');
        $this->addSql('DROP TABLE powiaty');
        $this->addSql('DROP INDEX IDX_35410348C05AA04F ON miasta');
        $this->addSql('ALTER TABLE miasta DROP powiat_id');
        $this->addSql('ALTER TABLE nieruchomosci ADD opis VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`');
    }
}
