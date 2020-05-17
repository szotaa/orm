<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200517134156 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE mieszkania (id INT AUTO_INCREMENT NOT NULL, nieruchomosc_id INT DEFAULT NULL, pietro INT NOT NULL, liczba_pieter INT NOT NULL, liczba_pokoi INT NOT NULL, rok_budowy INT NOT NULL, UNIQUE INDEX UNIQ_79DA2BB7C74FC62D (nieruchomosc_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Grunty (id INT AUTO_INCREMENT NOT NULL, nieruchomosc_id INT DEFAULT NULL, pozwolenie_na_budowe TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_5CAFEB36C74FC62D (nieruchomosc_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE powiaty (id INT AUTO_INCREMENT NOT NULL, wojewodztwo_id INT DEFAULT NULL, nazwa VARCHAR(255) NOT NULL, INDEX IDX_AEE5E2F13E8EA8F5 (wojewodztwo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dodatkowe (id INT AUTO_INCREMENT NOT NULL, nazwa VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nieruchomosci (id INT AUTO_INCREMENT NOT NULL, miasto_id INT DEFAULT NULL, typ_oferty VARCHAR(5) NOT NULL, numer VARCHAR(100) NOT NULL, powierzchnia DOUBLE PRECISION NOT NULL, cena DOUBLE PRECISION NOT NULL, cena_m2 DOUBLE PRECISION NOT NULL, INDEX IDX_16E054DDD2E14C8B (miasto_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nieruchomosc_komunikacja (nieruchomosc_id INT NOT NULL, komunikacja_id INT NOT NULL, INDEX IDX_8FCB7CDC74FC62D (nieruchomosc_id), INDEX IDX_8FCB7CDDA8337E3 (komunikacja_id), PRIMARY KEY(nieruchomosc_id, komunikacja_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE miasta (id INT AUTO_INCREMENT NOT NULL, powiat_id INT DEFAULT NULL, nazwa VARCHAR(255) NOT NULL, INDEX IDX_35410348C05AA04F (powiat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE komunikacja (id INT AUTO_INCREMENT NOT NULL, nazwa VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE materialy (id INT AUTO_INCREMENT NOT NULL, nazwa VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wojewodztwa (id INT AUTO_INCREMENT NOT NULL, nazwa VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Domy (id INT AUTO_INCREMENT NOT NULL, nieruchomosc_id INT DEFAULT NULL, powierzchnia_dzialki DOUBLE PRECISION NOT NULL, rok_budowy INT NOT NULL, UNIQUE INDEX UNIQ_8F334019C74FC62D (nieruchomosc_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mieszkania ADD CONSTRAINT FK_79DA2BB7C74FC62D FOREIGN KEY (nieruchomosc_id) REFERENCES nieruchomosci (id)');
        $this->addSql('ALTER TABLE Grunty ADD CONSTRAINT FK_5CAFEB36C74FC62D FOREIGN KEY (nieruchomosc_id) REFERENCES nieruchomosci (id)');
        $this->addSql('ALTER TABLE powiaty ADD CONSTRAINT FK_AEE5E2F13E8EA8F5 FOREIGN KEY (wojewodztwo_id) REFERENCES wojewodztwa (id)');
        $this->addSql('ALTER TABLE nieruchomosci ADD CONSTRAINT FK_16E054DDD2E14C8B FOREIGN KEY (miasto_id) REFERENCES miasta (id)');
        $this->addSql('ALTER TABLE nieruchomosc_komunikacja ADD CONSTRAINT FK_8FCB7CDC74FC62D FOREIGN KEY (nieruchomosc_id) REFERENCES nieruchomosci (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nieruchomosc_komunikacja ADD CONSTRAINT FK_8FCB7CDDA8337E3 FOREIGN KEY (komunikacja_id) REFERENCES komunikacja (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE miasta ADD CONSTRAINT FK_35410348C05AA04F FOREIGN KEY (powiat_id) REFERENCES powiaty (id)');
        $this->addSql('ALTER TABLE Domy ADD CONSTRAINT FK_8F334019C74FC62D FOREIGN KEY (nieruchomosc_id) REFERENCES nieruchomosci (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE miasta DROP FOREIGN KEY FK_35410348C05AA04F');
        $this->addSql('ALTER TABLE mieszkania DROP FOREIGN KEY FK_79DA2BB7C74FC62D');
        $this->addSql('ALTER TABLE Grunty DROP FOREIGN KEY FK_5CAFEB36C74FC62D');
        $this->addSql('ALTER TABLE nieruchomosc_komunikacja DROP FOREIGN KEY FK_8FCB7CDC74FC62D');
        $this->addSql('ALTER TABLE Domy DROP FOREIGN KEY FK_8F334019C74FC62D');
        $this->addSql('ALTER TABLE nieruchomosci DROP FOREIGN KEY FK_16E054DDD2E14C8B');
        $this->addSql('ALTER TABLE nieruchomosc_komunikacja DROP FOREIGN KEY FK_8FCB7CDDA8337E3');
        $this->addSql('ALTER TABLE powiaty DROP FOREIGN KEY FK_AEE5E2F13E8EA8F5');
        $this->addSql('DROP TABLE mieszkania');
        $this->addSql('DROP TABLE Grunty');
        $this->addSql('DROP TABLE powiaty');
        $this->addSql('DROP TABLE dodatkowe');
        $this->addSql('DROP TABLE nieruchomosci');
        $this->addSql('DROP TABLE nieruchomosc_komunikacja');
        $this->addSql('DROP TABLE miasta');
        $this->addSql('DROP TABLE komunikacja');
        $this->addSql('DROP TABLE materialy');
        $this->addSql('DROP TABLE wojewodztwa');
        $this->addSql('DROP TABLE Domy');
    }
}
